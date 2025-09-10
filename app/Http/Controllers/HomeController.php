<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bestSellers = Product::withCount('solds')->with('category')->orderBy('solds_count', 'desc')->take(4)->get();
        // return $bestSellers;
        return view('home', compact('bestSellers'));
    }

    public function category(Request $request)
    {
        $per_page = $request->input('per_page') ?? 12;
        $query = Product::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->orderBy('id', 'desc'); // Default sorting
            }
        }
        if ($request->has('priceRange')) {
            $priceRange = $request->input('priceRange');
            switch ($priceRange) {
                case 'under_100k':
                    $query->where('price', '<', 100000);
                    break;
                case '100kto500k':
                    $query->whereBetween('price', [100000, 500000]);
                    break;
                case '500kto1m':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case '1mto2m':
                    $query->whereBetween('price', [1000000, 2000000]);
                    break;
                case '2m_above':
                    $query->where('price', '>', 2000000);
                    break;
                default:
                    // No price filter
                    break;
            }
        }
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price');
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category_id', $category);
        }
        $products = $query->with(['category'])
                        ->withAvg('reviews as ratings', 'rating')
                        ->withCount('reviews')
                        ->paginate($per_page);
        $categories = ProductCategory::all();

        return view('category', compact('products', 'categories'));
    }

    public function productDetail($id)
    {
        $product = Product::with('category')
        ->withCount([
            'reviews',
            'reviews as five_stars' => function ($query) {
                $query->where('rating', 5);
            },
            'reviews as four_stars' => function ($query) {
                $query->where('rating', 4);
            },
            'reviews as three_stars' => function ($query) {
                $query->where('rating', 3);
            },
            'reviews as two_stars' => function ($query) {
                $query->where('rating', 2);
            },
            'reviews as one_stars' => function ($query) {
                $query->where('rating', 1);
            },
        ])
        ->withAvg('reviews as ratings', 'rating')
        ->findOrFail($id);

        $reviews = $product->reviews()->with(['user'])->latest()->cursorPaginate(5);
        
        return view('product-detail', compact('product', 'reviews'));
    }

    public function cart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart', compact('cartItems'));
    }

    public function checkout()
    {
        $products = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('checkout', compact('products'));
    }

    public function account()
    {
        $user = User::with(['wishlists', 'orders', 'reviews'])->findOrFail(auth()->id());
        return view('account', compact('user'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }

    public function addToCart($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function decrementCart($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }
    
    public function incrementCart($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            
            $cartItem->increment('quantity');
            
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        DB::beginTransaction();
            try {
                $shipment = Shipment::create([
                'user_id' => auth()->id(),
                'address_id' => $request->input('address_id'),
                'shipment_date' => now()
            ]);

            $total_price = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'amount' => $total_price,
                'payment_method' => $request->input('payment_method'),
                'payment_date' => now(),
            ]);

            $order = Order::create([
                'user_id' => auth()->id(),
                'shipment_id' => $shipment->id,
                'payment_id' => $payment->id,
                'order_date' => now(),
                'total_price' => $total_price
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            Cart::where('user_id', auth()->id())->delete();
            DB::commit();
            return redirect()->route('home')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function addToWishlist($id)
    {
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }
}

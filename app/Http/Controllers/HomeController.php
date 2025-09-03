<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

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
                        ->paginate($per_page);
        $categories = ProductCategory::all();
        return view('category', compact('products', 'categories'));
    }
}

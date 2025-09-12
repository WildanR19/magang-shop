@extends('layouts.shop')

@section('title', 'Cart')
@section('content')

@session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession
    <!-- Cart Section -->
    <section id="cart" class="cart section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="cart-items">
                        <div class="cart-header d-none d-lg-block">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h5>Product</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>Price</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>Quantity</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>Total</h5>
                                </div>
                            </div>
                        </div>

                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($cartItems as $cart)
                        <!-- Cart Item 1 -->
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-12 mt-3 mt-lg-0 mb-lg-0 mb-3">
                                    <div class="product-info d-flex align-items-center">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/' . $cart->product?->image) }}" alt="Product" class="img-fluid"
                                                loading="lazy">
                                        </div>
                                        <div class="product-details">
                                            <h6 class="product-title">{{ $cart->product?->name }}</h6>
                                            <div class="product-meta">
                                                <span class="product-color">{{ $cart->product?->description }}</span>
                                            </div>
                                            <a href="{{  route('cart.remove', $cart->product?->id) }}" class="remove-item" type="button">
                                                <i class="bi bi-trash"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                    <div class="price-tag">
                                        <span class="current-price">@currency($cart->product?->price)</span>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                    <div class="quantity-selector">
                                        <a href="{{ route('cart.decrement', $cart->product?->id) }}" class="quantity-btn decrease">
                                            <i class="bi bi-dash"></i>
                                        </a>
                                        <input type="number" class="quantity-input" value="{{ $cart->quantity }}" min="1" max="10">
                                        <a href="{{ route('cart.increment', $cart->product?->id) }}" class="quantity-btn increase">
                                            <i class="bi bi-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                    <div class="item-total">
                                        @php
                                            $price = $cart->product?->price;
                                            $quantity = $cart->quantity;
                                            $total = $price * $quantity;
                                            $subtotal += $total;
                                        @endphp
                                        <span>@currency($total)</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Cart Item -->
                            
                        @endforeach

                        <div class="cart-actions">
                            <div class="row">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <div class="coupon-form">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Coupon code">
                                            <button class="btn btn-outline-accent" type="button">Apply Coupon</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-md-end">
                                    <button class="btn btn-outline-heading me-2">
                                        <i class="bi bi-arrow-clockwise"></i> Update Cart
                                    </button>
                                    <a href="{{ route('cart.clear') }}" class="btn btn-outline-remove">
                                        <i class="bi bi-trash"></i> Clear Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="cart-summary">
                        <h4 class="summary-title">Order Summary</h4>

                        <div class="summary-item">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">@currency($subtotal)</span>
                        </div>

                        <div class="summary-item shipping-item">
                            <span class="summary-label">Shipping</span>
                            <div class="shipping-options">
                                <div class="form-check text-end">
                                    <input class="form-check-input" type="radio" name="shipping" id="standard" checked="">
                                    <label class="form-check-label" for="standard">
                                        Standard Delivery - @currency(10000)
                                    </label>
                                </div>
                                <div class="form-check text-end">
                                    <input class="form-check-input" type="radio" name="shipping" id="express">
                                    <label class="form-check-label" for="express">
                                        Express Delivery - @currency(13000)
                                    </label>
                                </div>
                                <div class="form-check text-end">
                                    <input class="form-check-input" type="radio" name="shipping" id="free">
                                    <label class="form-check-label" for="free">
                                        Free Shipping (Orders over @currency(300000))
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="summary-total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value">@currency($subtotal + 10000)</span>
                        </div>

                        <div class="checkout-button">
                            <a href="{{  route('checkout') }}" class="btn btn-accent w-100">
                                Proceed to Checkout <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <div class="continue-shopping">
                            <a href="{{  route('category') }}" class="btn btn-link w-100">
                                <i class="bi bi-arrow-left"></i> Continue Shopping
                            </a>
                        </div>

                        <div class="payment-methods">
                            <p class="payment-title">We Accept</p>
                            <div class="payment-icons">
                                <i class="bi bi-credit-card"></i>
                                <i class="bi bi-paypal"></i>
                                <i class="bi bi-wallet2"></i>
                                <i class="bi bi-bank"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Cart Section -->
@endsection
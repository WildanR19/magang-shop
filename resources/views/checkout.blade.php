@extends('layouts.shop')

@section('title', 'Checkout')
@section('content')

    <!-- Checkout Section -->
    <section id="checkout" class="checkout section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-7">
                    <!-- Checkout Form -->
                    <div class="checkout-container" data-aos="fade-up">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <!-- Customer Information -->
                            <div class="checkout-section" id="customer-info">
                                <div class="section-header">
                                    <div class="section-number">1</div>
                                    <h3>Customer Information</h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-group">
                                        <label for="first-name">Name</label>
                                        <input type="text" name="first-name" class="form-control" id="first-name"
                                            placeholder="Your First Name" value="{{ auth()->user()->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Your Email" value="{{ auth()->user()->email }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone" id="phone"
                                            placeholder="Your Phone Number" value="{{ auth()->user()->phone_number }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="checkout-section" id="shipping-address">
                                <div class="section-header">
                                    <div class="section-number">2</div>
                                    <h3>Shipping Address</h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <select class="form-select" id="address" name="address_id" required="">
                                            <option value="">Select Address</option>
                                            @foreach (auth()->user()->addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->postal_code }}, {{ $address->country }}</option>
                                                
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="checkout-section" id="payment-method">
                                <div class="section-header">
                                    <div class="section-number">3</div>
                                    <h3>Payment Method</h3>
                                </div>
                                <div class="section-content">
                                    <div class="payment-options">
                                        <div class="payment-option active">
                                            <input type="radio" name="payment_method" id="credit-card" checked="" value="credit_card">
                                            <label for="credit-card">
                                                <span class="payment-icon"><i class="bi bi-credit-card-2-front"></i></span>
                                                <span class="payment-label">Credit / Debit Card</span>
                                            </label>
                                        </div>
                                        <div class="payment-option">
                                            <input type="radio" name="payment_method" id="paypal" value="paypal">
                                            <label for="paypal">
                                                <span class="payment-icon"><i class="bi bi-paypal"></i></span>
                                                <span class="payment-label">PayPal</span>
                                            </label>
                                        </div>
                                        <div class="payment-option">
                                            <input type="radio" name="payment_method" id="apple-pay" value="apple_pay">
                                            <label for="apple-pay">
                                                <span class="payment-icon"><i class="bi bi-apple"></i></span>
                                                <span class="payment-label">Apple Pay</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="payment-details" id="credit-card-details">
                                        <div class="form-group">
                                            <label for="card-number">Card Number</label>
                                            <div class="card-number-wrapper">
                                                <input type="text" class="form-control" name="card-number" id="card-number"
                                                    placeholder="1234 5678 9012 3456" >
                                                <div class="card-icons">
                                                    <i class="bi bi-credit-card-2-front"></i>
                                                    <i class="bi bi-credit-card"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="expiry">Expiration Date</label>
                                                <input type="text" class="form-control" name="expiry" id="expiry"
                                                    placeholder="MM/YY" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="cvv">Security Code (CVV)</label>
                                                <div class="cvv-wrapper">
                                                    <input type="text" class="form-control" name="cvv" id="cvv"
                                                        placeholder="123" >
                                                    <span class="cvv-hint" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="3-digit code on the back of your card">
                                                        <i class="bi bi-question-circle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-name">Name on Card</label>
                                            <input type="text" class="form-control" name="card-name" id="card-name"
                                                placeholder="John Doe" >
                                        </div>
                                    </div>

                                    <div class="payment-details d-none" id="paypal-details">
                                        <p class="payment-info">You will be redirected to PayPal to complete your purchase
                                            securely.</p>
                                    </div>

                                    <div class="payment-details d-none" id="apple-pay-details">
                                        <p class="payment-info">You will be prompted to authorize payment with Apple Pay.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Review -->
                            <div class="checkout-section" id="order-review">
                                <div class="section-header">
                                    <div class="section-number">4</div>
                                    <h3>Review &amp; Place Order</h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-check terms-check">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required="">
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#termsModal">Terms and Conditions</a> and <a href="#"
                                                data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                                        </label>
                                    </div>
                                    <div class="success-message d-none">Your order has been placed successfully! Thank you
                                        for your purchase.</div>
                                    <div class="place-order-container">
                                        <button type="submit" class="btn btn-primary place-order-btn">
                                            <span class="btn-text">Place Order</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <!-- Order Summary -->
                    <div class="order-summary" data-aos="fade-left" data-aos-delay="200">
                        <div class="order-summary-header">
                            <h3>Order Summary</h3>
                            <span class="item-count">{{ $products->count() }} Items</span>
                        </div>

                        <div class="order-summary-content">
                            <div class="order-items">
                                @php
                                    $subtotal = 0;
                                @endphp
                            @foreach ($products as $product)
                                <div class="order-item">
                                    <div class="order-item-image">
                                        <img src="{{ asset('storage/' . $product->product?->image) }}" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="order-item-details">
                                        <h4>{{ $product->product?->name }}</h4>
                                        <p class="order-item-variant">{{ $product->product->description }}</p>
                                        <div class="order-item-price">
                                            <span class="quantity">{{ $product->quantity }} ×</span>
                                            <span class="price">@currency($product->product->price)</span>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $subtotal += $product->product->price * $product->quantity;
                                @endphp    
                            @endforeach
                            </div>

                            <div class="promo-code">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo Code"
                                        aria-label="Promo Code">
                                    <button class="btn btn-outline-primary" type="button">Apply</button>
                                </div>
                            </div>

                            <div class="order-totals">
                                <div class="order-subtotal d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span>@currency($subtotal)</span>
                                </div>
                                <div class="order-shipping d-flex justify-content-between">
                                    <span>Shipping</span>
                                    <span>@currency(10000)</span>
                                </div>
                                <div class="order-total d-flex justify-content-between">
                                    <span>Total</span>
                                    <span>@currency($subtotal + 10000)</span>
                                </div>
                            </div>

                            <div class="secure-checkout">
                                <div class="secure-checkout-header">
                                    <i class="bi bi-shield-lock"></i>
                                    <span>Secure Checkout</span>
                                </div>
                                <div class="payment-icons">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    <i class="bi bi-credit-card"></i>
                                    <i class="bi bi-paypal"></i>
                                    <i class="bi bi-apple"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terms and Privacy Modals -->
            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus
                                hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend
                                nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis
                                nisl tempor.</p>
                            <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque
                                eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non
                                est bibendum non venenatis nisl tempor.</p>
                            <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque
                                eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non
                                est bibendum non venenatis nisl tempor.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus
                                hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend
                                nibh porttitor. Ut in nulla enim.</p>
                            <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque
                                eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non
                                est bibendum non venenatis nisl tempor.</p>
                            <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque
                                eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non
                                est bibendum non venenatis nisl tempor.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Checkout Section -->

@endsection
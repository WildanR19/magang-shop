@extends('layouts.shop')

@section('title', 'Product Details')
@section('content')

    <!-- Product Details Section -->
    <section id="product-details" class="product-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4">
                <!-- Product Gallery -->
                <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="150">
                    <div class="product-gallery">
                        <div class="main-showcase">
                            <div class="image-zoom-container">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Main"
                                    class="img-fluid main-product-image drift-zoom" id="main-product-image"
                                    data-zoom="{{ asset('storage/' . $product->image) }}">

                                <div class="image-navigation">
                                    <button class="nav-arrow prev-image image-nav-btn prev-image" type="button">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="nav-arrow next-image image-nav-btn next-image" type="button">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-details">
                        <div class="product-badge-container">
                            <span class="badge-category">{{ $product->category->name }}</span>
                            <div class="rating-group">
                                <div class="stars">
                                    @for ($i=0;$i <= $product->ratings; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <span class="review-text">({{ $product->reviews_count }})</span>
                            </div>
                        </div>

                        <h1 class="product-name">{{ $product->name }}</h1>

                        <div class="pricing-section">
                            <div class="price-display">
                                <span class="sale-price">@currency($product->price)</span>
                            </div>
                        </div>

                        <div class="product-description">
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="availability-status">
                            <div class="stock-indicator">
                                <i class="bi bi-check-circle-fill"></i>
                                <span class="stock-text">{{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}</span>
                            </div>
                            <div class="quantity-left">Only {{ $product->stock }} items remaining</div>
                        </div>

                        <!-- Purchase Options -->
                        <div class="purchase-section">
                            <div class="quantity-control">
                                <label class="control-label">Quantity:</label>
                                <div class="quantity-input-group">
                                    <div class="quantity-selector">
                                        <button class="quantity-btn decrease" type="button">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" class="quantity-input" value="1" min="1" max="{{ $product->stock }}">
                                        <button class="quantity-btn increase" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <button class="btn primary-action">
                                    <i class="bi bi-bag-plus"></i>
                                    Add to Cart
                                </button>
                                <button class="btn secondary-action">
                                    <i class="bi bi-lightning"></i>
                                    Buy Now
                                </button>
                                <button class="btn icon-action" title="Add to Wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Benefits List -->
                        <div class="benefits-list">
                            <div class="benefit-item">
                                <i class="bi bi-truck"></i>
                                <span>Free delivery on orders over $75</span>
                            </div>
                            <div class="benefit-item">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span>45-day hassle-free returns</span>
                            </div>
                            <div class="benefit-item">
                                <i class="bi bi-shield-check"></i>
                                <span>3-year manufacturer warranty</span>
                            </div>
                            <div class="benefit-item">
                                <i class="bi bi-headset"></i>
                                <span>24/7 customer support available</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Tabs -->
            <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
                <div class="col-12">
                    <div class="info-tabs-container">
                        <nav class="tabs-navigation nav">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-overview" type="button">Overview</button>
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-technical" type="button">Technical
                                Details</button>
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-customer-reviews" type="button">Reviews
                                (127)</button>
                        </nav>

                        <div class="tab-content">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="ecommerce-product-details-5-overview">
                                <div class="overview-content">
                                    <div class="row g-4">
                                        <div class="col-lg-8">
                                            <div class="content-section">
                                                <h3>Product Overview</h3>
                                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                                    fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem
                                                    sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor
                                                    sit amet, consectetur, adipisci velit.</p>

                                                <h4>Key Highlights</h4>
                                                <div class="highlights-grid">
                                                    <div class="highlight-card">
                                                        <i class="bi bi-volume-up"></i>
                                                        <h5>Superior Audio</h5>
                                                        <p>Ut enim ad minima veniam quis nostrum exercitationem</p>
                                                    </div>
                                                    <div class="highlight-card">
                                                        <i class="bi bi-battery-charging"></i>
                                                        <h5>Long Battery</h5>
                                                        <p>Excepteur sint occaecat cupidatat non proident</p>
                                                    </div>
                                                    <div class="highlight-card">
                                                        <i class="bi bi-wifi"></i>
                                                        <h5>Wireless Tech</h5>
                                                        <p>Duis aute irure dolor in reprehenderit in voluptate</p>
                                                    </div>
                                                    <div class="highlight-card">
                                                        <i class="bi bi-person-check"></i>
                                                        <h5>Comfort Fit</h5>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipiscing</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="package-contents">
                                                <h4>Package Contents</h4>
                                                <ul class="contents-list">
                                                    <li><i class="bi bi-check-circle"></i>Premium Audio Device</li>
                                                    <li><i class="bi bi-check-circle"></i>Premium Carrying Case</li>
                                                    <li><i class="bi bi-check-circle"></i>USB-C Fast Charging Cable</li>
                                                    <li><i class="bi bi-check-circle"></i>3.5mm Audio Connector</li>
                                                    <li><i class="bi bi-check-circle"></i>Quick Start Guide</li>
                                                    <li><i class="bi bi-check-circle"></i>Warranty Documentation</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Details Tab -->
                            <div class="tab-pane fade" id="ecommerce-product-details-5-technical">
                                <div class="technical-content">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Audio Specifications</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Frequency Range</span>
                                                        <span class="spec-value">15Hz - 25kHz</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Driver Diameter</span>
                                                        <span class="spec-value">50mm Dynamic</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Sensitivity</span>
                                                        <span class="spec-value">98dB SPL</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Impedance</span>
                                                        <span class="spec-value">24 Ohm</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">THD</span>
                                                        <span class="spec-value">&lt; 0.5%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Connectivity &amp; Power</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Wireless Protocol</span>
                                                        <span class="spec-value">Bluetooth 5.3</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Range</span>
                                                        <span class="spec-value">Up to 30ft (10m)</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Battery Capacity</span>
                                                        <span class="spec-value">800mAh Li-ion</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Usage Time</span>
                                                        <span class="spec-value">35+ hours</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Charge Time</span>
                                                        <span class="spec-value">2.5 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Physical Dimensions</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Weight</span>
                                                        <span class="spec-value">285g</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Dimensions</span>
                                                        <span class="spec-value">190 x 165 x 82mm</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Ear Cup Material</span>
                                                        <span class="spec-value">Memory Foam</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Headband</span>
                                                        <span class="spec-value">Adjustable Steel</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Advanced Features</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Noise Cancellation</span>
                                                        <span class="spec-value">Hybrid ANC</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Voice Assistant</span>
                                                        <span class="spec-value">Siri &amp; Google</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Microphone Type</span>
                                                        <span class="spec-value">Dual Array</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Water Rating</span>
                                                        <span class="spec-value">IPX5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="ecommerce-product-details-5-customer-reviews">
                                <div class="reviews-content">
                                    <div class="reviews-header">
                                        <div class="rating-overview">
                                            <div class="average-score">
                                                <div class="score-display">{{ round($product->ratings, 1) }}</div>
                                                <div class="score-stars">
                                                    @for ($i=0;$i <= $product->ratings; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                    @endfor
                                                </div>
                                                <div class="total-reviews">{{ $product->reviews_count }} customer reviews</div>
                                            </div>

                                            <div class="rating-distribution">
                                                <div class="rating-row">
                                                    <span class="stars-label">5★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: {{ $product->five_stars / $product->reviews_count * 100}}%;"></div>
                                                    </div>
                                                    <span class="count-label">{{ $product->five_stars }}</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">4★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: {{ $product->four_stars / $product->reviews_count * 100}}%;"></div>
                                                    </div>
                                                    <span class="count-label">{{ $product->four_stars }}</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">3★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: {{ $product->three_stars / $product->reviews_count * 100}}%;"></div>
                                                    </div>
                                                    <span class="count-label">{{ $product->three_stars }}</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">2★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: {{ $product->two_stars / $product->reviews_count * 100}}%;"></div>
                                                    </div>
                                                    <span class="count-label">{{ $product->two_stars }}</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">1★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: {{ $product->one_stars / $product->reviews_count * 100}}%;"></div>
                                                    </div>
                                                    <span class="count-label">{{ $product->one_stars }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="write-review-cta">
                                            <h4>Share Your Experience</h4>
                                            <p>Help others make informed decisions</p>
                                            <button class="btn review-btn">Write Review</button>
                                        </div>
                                    </div>

                                    <div class="customer-reviews-list" id="review-list">
                                        @foreach ($reviews as $review)
                                            <div class="review-card">
                                                <div class="reviewer-profile">
                                                    <img src="assets/img/person/person-f-3.webp" alt="Customer"
                                                        class="profile-pic">
                                                    <div class="profile-details">
                                                        <div class="customer-name">{{ $review->user->name }}</div>
                                                        <div class="review-meta">
                                                            <div class="review-stars">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </div>
                                                            <span class="review-date">{{ $review->created_at }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-text">
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                                <div class="review-actions">
                                                    <button class="action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful
                                                        (12)</button>
                                                    <button class="action-btn"><i class="bi bi-chat-dots"></i> Reply</button>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($reviews->hasMorePages())
                                            <div class="load-more-section" id="load-more" data-next="{{ $reviews->nextCursor()?->encode() }}">
                                                <button class="btn load-more-reviews">Show More Reviews</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Product Details Section -->
@endsection
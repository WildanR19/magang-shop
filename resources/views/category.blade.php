@extends('layouts.shop')

@section('title', 'Category')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>

            @endif
        </div>

        <div class="col-lg-4 sidebar">

            <div class="widgets-container">
                <!-- Product Categories Widget -->
                <div class="product-categories-widget widget-item">

                    <h3 class="widget-title">Categories</h3>

                    <ul class="category-tree list-unstyled mb-0">
                        <!-- Clothing Category -->
                        @foreach($categories as $category)
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header">
                                    <a href="{{ route('category', ['category' => $category->id]) }}"
                                        class="category-link">{{ $category->name }}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <!--/Product Categories Widget -->

                <!-- Pricing Range Widget -->
                <div class="pricing-range-widget widget-item">

                    <h3 class="widget-title">Price Range</h3>

                    <form action="{{ route('category') }}" method="GET">
                        <div class="price-range-container">
                            <div class="current-range mb-3">
                                <span class="min-price">Rp 0</span>
                                <span class="max-price float-end">Rp 10.000.000</span>
                            </div>

                            <div class="range-slider">
                                <div class="slider-track"></div>
                                <div class="slider-progress"></div>
                                <input type="range" class="min-range" min="0" max="10000000" value="0" step="10000">
                                <input type="range" class="max-range" min="0" max="10000000" value="5000000"
                                    step="10000">
                            </div>

                            <div class="price-inputs mt-3">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control min-price-input" name="min_price"
                                                placeholder="Min" min="0" max="10000000" value="0" step="10">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control max-price-input" name="max_price"
                                                placeholder="Max" min="0" max="10000000" value="500" step="10">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-actions mt-3">
                                <button type="submit" class="btn btn-sm btn-primary w-100">Apply Filter</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!--/Pricing Range Widget -->
            </div>

        </div>

        <div class="col-lg-8">

            <!-- Category Header Section -->
            <section id="category-header" class="category-header section">

                <div class="container" data-aos="fade-up">

                    <!-- Filter and Sort Options -->
                    <form action="{{ route('category') }}" method="GET">
                        <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="filter-item search-form">
                                        <label for="productSearch" class="form-label">Search Products</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="productSearch" name="search"
                                                placeholder="Search for products..." aria-label="Search for products"
                                                value="{{ request('search') }}">
                                            <button class="btn search-btn btn-primary" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label for="priceRange" class="form-label">Price Range</label>
                                        <select class="form-select" id="priceRange" name="priceRange">
                                            <option selected="" value="all">All Prices</option>
                                            <option value="under_100k">Under Rp 100.000</option>
                                            <option value="100kto500k">Rp 100.000 to Rp 500.000</option>
                                            <option value="500kto1m">Rp 500.000 to Rp 1.000.000</option>
                                            <option value="1mto2m">Rp 1.000.000 to Rp 2.000.000</option>
                                            <option value="2m_above">Rp 2.000.000 &amp; Above</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label for="sortBy" class="form-label">Sort By</label>
                                        <select class="form-select" id="sortBy" name="sort">
                                            <option selected="" value="featured">Featured</option>
                                            <option value="price_asc">Price: Low to High</option>
                                            <option value="price_desc">Price: High to Low</option>
                                            <option value="newest">Newest Arrivals</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="filter-item">
                                        <label class="form-label">View</label>
                                        <div class="d-flex align-items-center">
                                            <div class="view-options me-3">
                                                <button type="button" class="btn view-btn active" data-view="grid"
                                                    aria-label="Grid view">
                                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                                </button>
                                                <button type="button" class="btn view-btn" data-view="list"
                                                    aria-label="List view">
                                                    <i class="bi bi-list-ul"></i>
                                                </button>
                                            </div>
                                            <div class="items-per-page">
                                                <select class="form-select" id="itemsPerPage"
                                                    aria-label="Items per page" name="per_page">
                                                    <option value="12">12 per page</option>
                                                    <option value="24">24 per page</option>
                                                    <option value="48">48 per page</option>
                                                    <option value="96">96 per page</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Apply Filter</button>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="active-filters">
                                        <span class="active-filter-label">Active Filters:</span>
                                        <div class="filter-tags">
                                            @php
                                                $activeFilters = request()->all();
                                            @endphp
                                            @foreach($activeFilters as $filter)
                                                @if(!isset($filter))
                                                    @continue
                                                @endif
                                                <span class="filter-tag">
                                                    {{ $filter }} <button class="filter-remove"><i
                                                            class="bi bi-x"></i></button>
                                                </span>

                                            @endforeach
                                            <a href="{{ route('category') }}"
                                                class="clear-all-btn">Clear All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </section><!-- /Category Header Section -->

            <!-- Category Product List Section -->
            <section id="category-product-list" class="category-product-list section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row g-4">
                        @foreach($products as $product)
                            <!-- Product 1 -->
                            <div class="col-6 col-xl-4">
                                <div class="product-card" data-aos="zoom-in">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="img-fluid" alt="Product">
                                        <div class="product-overlay">
                                            <div class="product-actions">
                                                <a type="button" class="action-btn" data-bs-toggle="tooltip"
                                                    title="Quick View"
                                                    href="{{ route('product.detail', $product->id) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('wishlist.add', $product->id) }}"
                                                    type="button" class="action-btn" data-bs-toggle="tooltip"
                                                    title="Wishlist">
                                                    <i class="bi bi-heart"></i>
                                                </a>
                                                <a href="{{ route('cart.add', $product->id) }}"
                                                    type="button" class="action-btn" data-bs-toggle="tooltip"
                                                    title="Add to Cart">
                                                    <i class="bi bi-cart-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-category">{{ $product->category?->name }}</div>
                                        <h4 class="product-title"><a
                                                href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                        </h4>
                                        <div class="product-meta">
                                            <div class="product-price">@currency($product->price)</div>
                                            <div class="product-rating">
                                                <i class="bi bi-star-fill"></i>
                                                {{ $product->ratings ?? 0 }} <span>({{ $product->reviews_count }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </section><!-- /Category Product List Section -->

            <!-- Category Pagination Section -->
            <section id="category-pagination" class="category-pagination section">

                <div class="container">
                    {{ $products->links() }}
                </div>

            </section><!-- /Category Pagination Section -->

        </div>

    </div>
</div>

@endsection

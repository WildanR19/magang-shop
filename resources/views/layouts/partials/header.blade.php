<header id="header" class="header sticky-top">
    <!-- Top Bar -->
    <div class="top-bar py-2">
        <div class="container-fluid container-xl">
            <div class="row align-items-center">
                <div class="col-lg-4 d-none d-lg-flex">
                    <div class="top-bar-item">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <span>Need help? Call us: </span>
                        <a href="tel:+1234567890">+1 (234) 567-890</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 text-center">
                    <div class="announcement-slider swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 1,
                  "direction": "vertical",
                  "effect": "slide"
                }
              </script>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">🚚 Free shipping on orders over $50</div>
                            <div class="swiper-slide">💰 30 days money back guarantee.</div>
                            <div class="swiper-slide">🎁 20% off on your first order</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container-fluid container-xl">
            <div class="d-flex py-3 align-items-center justify-content-between">

                <!-- Logo -->
                <a href="index.html" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.webp" alt=""> -->
                    <h1 class="sitename">NiceShop</h1>
                </a>

                <!-- Search -->
                <form class="search-form desktop-search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Actions -->
                <div class="header-actions d-flex align-items-center justify-content-end">

                    <!-- Mobile Search Toggle -->
                    <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                        aria-controls="mobileSearch">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Account -->
                    <div class="dropdown account-dropdown">
                        <button class="header-action-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-header">
                                <h6>Welcome <span class="sitename">{{ auth()->user()->name ?? 'back' }}</span></h6>
                                <p class="mb-0">Access account &amp; manage orders</p>
                            </div>
                            @if (auth()->check())
                                <div class="dropdown-body">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('account') }}">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>My Profile</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('account') }}">
                                        <i class="bi bi-bag-check me-2"></i>
                                        <span>My Orders</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('account') }}">
                                        <i class="bi bi-heart me-2"></i>
                                        <span>My Wishlist</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('account') }}">
                                        <i class="bi bi-gear me-2"></i>
                                        <span>Settings</span>
                                    </a>
                                </div>
                            @endif
                            <div class="dropdown-footer">
                                @if (auth()->check())
                                    <a href="{{ route('logout') }}" class="btn btn-primary w-100 mb-2"
                                    onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @else
                                <a href="{{ route('user.login') }}" class="btn btn-primary w-100 mb-2">Sign In</a>
                                <a href="{{ route('user.register') }}"
                                    class="btn btn-outline-primary w-100">Register</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <a href="{{ route('account') }}" class="header-action-btn d-none d-md-block">
                        <i class="bi bi-heart"></i>
                        <span class="badge">{{ auth()->user() ? App\Models\Wishlist::where('user_id', auth()->user()->id)->count() : 0 }}</span>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart') }}" class="header-action-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="badge">{{ auth()->user() ? App\Models\Cart::where('user_id', auth()->user()->id)->count() : 0 }}</span>
                    </a>

                    <!-- Mobile Navigation Toggle -->
                    <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
        <div class="container-fluid container-xl position-relative">
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">Home</a></li>
                    <li><a href="{{ route('category') }}">Category</a></li>
                    <li><a href="{{ route('checkout') }}">Checkout</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Mobile Search Form -->
    <div class="collapse" id="mobileSearch">
        <div class="container">
            <form class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <button class="btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

</header>
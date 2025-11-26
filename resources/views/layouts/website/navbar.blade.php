<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid px-5 d-none border-bottom d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-4 text-center text-lg-start mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="#" class="text-muted me-2"> Help</a><small> / </small>
                <a href="#" class="text-muted mx-2"> Support</a><small> / </small>
               <a href="{{ route('contact.contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }} me-2">Contact</a>
            </div>
        </div>
        <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
            <small class="text-dark">Call Us:</small>
    <a href="tel:{{ $settings->telephone ?? '' }}" class="text-muted">{{ $settings->telephone ?? '(+012) 1234 567890' }}</a>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted me-2" data-bs-toggle="dropdown"><small> USD</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item"> Euro</a>
                        <a href="#" class="dropdown-item"> Dolar</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted mx-2" data-bs-toggle="dropdown"><small> English</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item"> English</a>
                        <a href="#" class="dropdown-item"> Turkish</a>
                        <a href="#" class="dropdown-item"> Spanol</a>
                        <a href="#" class="dropdown-item"> Italiano</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted ms-2" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item"> Login</a>
                        <a href="#" class="dropdown-item"> Wishlist</a>
                        <a href="#" class="dropdown-item"> My Card</a>
                        <a href="#" class="dropdown-item"> Notifications</a>
                        <a href="#" class="dropdown-item"> Account Settings</a>
                        <a href="#" class="dropdown-item"> My Account</a>
                        <a href="#" class="dropdown-item"> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="{{ route('website.home') }}" class="navbar-brand p-0">
                    <h1 class="display-5 text-primary m-0"><i class="fas fa-shopping-bag text-secondary me-2"></i>{{ $settings->website_name ?? 'Electro' }}</h1>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <form action="{{ route('website.search') }}" method="GET">
                    <div class="d-flex border rounded-pill">
                        <input class="form-control border-0 rounded-pill w-100 py-3" type="text" name="search" placeholder="Search Looking For?" value="{{ request('search') }}">
                        <select class="form-select text-dark border-0 border-start rounded-0 p-3" name="category_id" style="width: 200px;">
                            <option value="">All Category</option>
                            {{-- Loop Categories Here --}}
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <button type="submit" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-md-square border"><i class="fas fa-random"></i></span></a>
                <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-md-square border"><i class="fas fa-heart"></i></span></a>
                <a href="#" class="text-muted d-flex align-items-center justify-content-center"><span class="rounded-circle btn-md-square border"><i class="fas fa-shopping-cart"></i></span> <span class="text-dark ms-2">$0.00</span></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">
        <div class="col-lg-3 d-none d-lg-block">
            <nav class="navbar navbar-light position-relative" style="width: 250px;">
                <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#allCat">
                    <h4 class="m-0"><i class="fa fa-bars me-2"></i>All Categories</h4>
                </button>
                <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                    <div class="navbar-nav ms-auto py-0">
                        <ul class="list-unstyled categories-bars">
                            {{-- Dynamic Categories --}}
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">{{ $category->name }}</a>
                                            <span>({{ $category->products_count ?? 0 }})</span>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">Accessories</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <a href="{{ route('website.home') }}" class="navbar-brand d-block d-lg-none">
                    <h1 class="display-5 text-secondary m-0"><i class="fas fa-shopping-bag text-white me-2"></i>Electro</h1>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ route('website.home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('products.products') }}" class="nav-item nav-link {{ request()->is('shop') ? 'active' : '' }}">Shop</a>
                        <a href="{{ route('shopcart.index') }}" class="nav-item nav-link">Shop Cart</a>
                        <a href="{{ route('checkout.index') }}" class="nav-item nav-link">Checkout</a>
                        <a href="{{ route('contact.contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }} me-2">Contact</a>
                        <div class="nav-item dropdown d-block d-lg-none mb-3">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><span class="dropdown-toggle">All Category</span></a>
                            <div class="dropdown-menu m-0">
                                <ul class="list-unstyled categories-bars">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <li>
                                                <div class="categories-bars-item">
                                                    <a href="#">{{ $category->name }}</a>
                                                    <span>({{ $category->products_count ?? 0 }})</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
<div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
    <small class="text-dark">Call Us:</small>
    <a href="tel:{{ $settings->telephone ?? '' }}" class="text-muted">{{ $settings->telephone ?? '(+012) 1234 567890' }}</a>
</div>                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->
@extends('layouts.website.app')

@section('title', 'Products - Electro')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">
            @if(isset($search) && $search)
                Search Results for "{{ $search }}"
            @elseif(isset($category))
                {{ $category->name }}
            @else
                Shop Page
            @endif
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Products</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
@include('website.partials.services')
@include('website.partials.offers')

    <!-- Shop Page Start -->
        <div class="container-fluid shop py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-categories mb-4">
                            <h4>Products Categories</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i> Accessories</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i> Electronics & Computer</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>Laptops & Desktops</a>
                                        <span>(2)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>Mobiles & Tablets</a>
                                        <span>(8)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>SmartPhone & Smart TV</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="price mb-4">
                            <h4 class="mb-2">Price</h4>
                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                            <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                            <div class=""></div>
                        </div>
                        <div class="product-color mb-3">
                            <h4>Select By Color</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="product-color-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i> Gold</a>
                                        <span>(1)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-color-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>  Green</a>
                                        <span>(1)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-color-item">
                                        <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i> White</a>
                                        <span>(1)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="additional-product mb-4">
                            <h4>Additional Products</h4>
                            <div class="additional-product-item">
                                <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                                <label for="Categories-1" class="text-dark"> Accessories</label>
                            </div>
                            <div class="additional-product-item">
                                <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                                <label for="Categories-2" class="text-dark"> Electronics & Computer</label>
                            </div>
                            <div class="additional-product-item">
                                <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                                <label for="Categories-3" class="text-dark"> Laptops & Desktops</label>
                            </div>
                            <div class="additional-product-item">
                                <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                                <label for="Categories-4" class="text-dark"> Mobiles & Tablets</label>
                            </div>
                            <div class="additional-product-item">
                                <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                                <label for="Categories-5" class="text-dark"> SmartPhone & Smart TV</label>
                            </div>
                        </div>
                        <div class="featured-product mb-4">
                            <h4 class="mb-3">Featured products</h4>
                            <div class="featured-product-item">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('website/img/product-3.png') }}" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">SmartPhone</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-product-item">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('website/img/product-4.png') }}" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Smart Camera</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-product-item">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('website/img/product-5.png') }}" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Camera Leance</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <a href="#" class="btn btn-primary px-4 py-3 rounded-pill w-100">Vew More</a>
                            </div>
                        </div>
                        <a href="#">
                            <div class="position-relative">
                                <img src="{{ asset('website/img/product-banner-2.jpg') }}" class="img-fluid w-100 rounded" alt="Image">
                                <div class="text-center position-absolute d-flex flex-column align-items-center justify-content-center rounded p-4" style="width: 100%; height: 100%; top: 0; right: 0; background: rgba(242, 139, 0, 0.3);">
                                    <h5 class="display-6 text-primary">SALE</h5>
                                    <h4 class="text-secondary">Get UP To 50% Off</h4>
                                    <a href="#" class="btn btn-primary rounded-pill px-4">Shop Now</a>
                                </div>
                            </div>
                        </a>
                        <div class="product-tags py-4">
                            <h4 class="mb-3">PRODUCT TAGS</h4>
                            <div class="product-tags-items bg-light rounded p-3">
                                <a href="#" class="border rounded py-1 px-2 mb-2">New</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">brand</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">black</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">white</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">tablats</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">phone</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">camera</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">drone</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">talevision</a>
                                <a href="#" class="border rounded py-1 px-2 mb-2">slaes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded mb-4 position-relative">
                            <img src="{{ asset('website/img/product-banner-3.jpg') }}" class="img-fluid rounded w-100" style="height: 250px;" alt="Image">
                            <div class="position-absolute rounded d-flex flex-column align-items-center justify-content-center text-center" style="width: 100%; height: 250px; top: 0; left: 0; background: rgba(242, 139, 0, 0.3);">
                                <h4 class="display-5 text-primary">SALE</h4>
                                <h3 class="display-4 text-white mb-4">Get UP To 50% Off</h3>
                                <a href="#" class="btn btn-primary rounded-pill">Shop Now</a>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-xl-7">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-xl-3 text-end">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                                    <label for="electronics">Sort By:</label>
                                    <select id="electronics" name="electronicslist" class="border-0 form-select-sm bg-light me-3" form="electronicsform">
                                        <option value="volvo">Default Sorting</option>
                                        <option value="volv">Nothing</option>
                                        <option value="sab">Popularity</option>
                                        <option value="saab">Newness</option>
                                        <option value="opel">Average Rating</option>
                                        <option value="audio">Low to high</option>
                                        <option value="audi">High to low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-2">
                                <ul class="nav nav-pills d-inline-flex text-center py-2 px-2 rounded bg-light mb-4">
                                    <li class="nav-item me-4">
                                        <a class="bg-light" data-bs-toggle="pill" href="#tab-5">
                                            <i class="fas fa-th fa-3x text-primary"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="bg-light" data-bs-toggle="pill" href="#tab-6">
                                            <i class="fas fa-bars fa-3x text-primary"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                       <!-- Products Section Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            
            @if(isset($search) && $search)
                <div class="alert alert-info">
                    Found {{ $products->total() }} products matching "{{ $search }}"
                </div>
            @endif

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="rounded position-relative product-card h-100">
                            <div class="position-relative overflow-hidden rounded-top">
                                  @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                    class="card-img-top" 
                                    alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="p-4 border border-top-0 rounded-bottom">
                                <h5 class="mb-2">{{ $product->name }}</h5>
                                <p class="text-muted mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                @if($product->description)
                                    <p class="text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fs-5 fw-bold">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.productDetails', $product->id) }}" 
                                       class="btn btn-sm btn-primary rounded-pill px-3">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-shopping-bag fa-5x text-muted mb-4"></i>
                        <h4 class="text-muted">No products found</h4>
                        @if(isset($search))
                            <p>Try searching with different keywords</p>
                        @endif
                        <a href="{{ route('website.products') }}" class="btn btn-primary rounded-pill py-2 px-4 mt-3">
                            View All Products
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
      @if($products->hasPages())
    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
        <div class="pagination d-flex justify-content-center mt-5">
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <span class="rounded">&laquo;</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($products->links()->elements[0] as $page => $url)
                @if ($page == $products->currentPage())
                    <span class="active rounded">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
            @else
                <span class="rounded">&raquo;</span>
            @endif
        </div>
    </div>
@endif
 
        </div>
        </div>
    </div>

    <div class="container-fluid py-5">
            <div class="container pb-5">
                <div class="row g-4">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <a href="#">
                            <div class="bg-primary rounded position-relative">
                                <img src="{{ asset('website/img/product-banner.jpg') }}" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4" style="background: rgba(255, 255, 255, 0.5);">
                                    <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                                    <p class="fs-4 text-muted">$899.99</p>
                                    <a href="#" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <a href="#">
                            <div class="text-center bg-primary rounded position-relative">
                                <img src="{{ asset('website/img/product-banner-2.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4" style="background: rgba(242, 139, 0, 0.5);">
                                    <h2 class="display-2 text-secondary">SALE</h2>
                                    <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                                    <a href="#" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop Now</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Page End -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- Products Section End -->
@endsection
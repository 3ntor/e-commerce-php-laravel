<div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
    <div class="carousel-header-banner h-100">
        @if($banner)
            <img src="{{ asset('storage/' . $banner->image) }}" 
                 class="img-fluid w-100 h-100" 
                 style="object-fit: cover;" 
                 alt="{{ $banner->title }}">
            
            @if($banner->offer_text || $banner->offer_label)
                <div class="carousel-banner-offer">
                    @if($banner->offer_text)
                        <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">
                            {{ $banner->offer_text }}
                        </p>
                    @endif
                    @if($banner->offer_label)
                        <p class="text-primary fs-5 fw-bold mb-0">{{ $banner->offer_label }}</p>
                    @endif
                </div>
            @endif
            
            <div class="carousel-banner">
                <div class="carousel-banner-content text-center p-4">
                    <a href="#" class="d-block mb-2">Product</a>
                    <a href="#" class="d-block text-white fs-3">
                        {{ $banner->product_name ?? 'Special Product' }}
                    </a>
                    @if($banner->old_price)
                        <del class="me-2 text-white fs-5">${{ number_format($banner->old_price, 2) }}</del>
                    @endif
                    @if($banner->new_price)
                        <span class="text-primary fs-5">${{ number_format($banner->new_price, 2) }}</span>
                    @endif
                </div>
                @if($banner->button_text && $banner->button_link)
                    <a href="{{ $banner->button_link }}" class="btn btn-primary rounded-pill py-2 px-4">
                        <i class="fas fa-shopping-cart me-2"></i> {{ $banner->button_text }}
                    </a>
                @endif
            </div>
        @else
            <img src="{{ asset('website/img/header-img.jpg') }}" 
                 class="img-fluid w-100 h-100" 
                 style="object-fit: cover;" 
                 alt="Image">
            <div class="carousel-banner-offer">
                <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Save $48.00</p>
                <p class="text-primary fs-5 fw-bold mb-0">Special Offer</p>
            </div>
            <div class="carousel-banner">
                <div class="carousel-banner-content text-center p-4">
                    <a href="#" class="d-block mb-2">SmartPhone</a>
                    <a href="#" class="d-block text-white fs-3">Apple iPad Mini <br> G2356</a>
                    <del class="me-2 text-white fs-5">$1,250.00</del>
                    <span class="text-primary fs-5">$1,050.00</span>
                </div>
                <a href="#" class="btn btn-primary rounded-pill py-2 px-4">
                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                </a>
            </div>
        @endif
    </div>
</div>
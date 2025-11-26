<div class="container-fluid carousel bg-light px-0">
    <div class="row g-0 justify-content-end">
        <div class="col-12 col-lg-7 col-xl-9">
            <div class="header-carousel owl-carousel bg-light py-5">
                @forelse($sliders as $slider)
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $slider->title }}">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            @if($slider->subtitle)
                                <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" 
                                    data-wow-delay="0.1s" 
                                    style="letter-spacing: 3px;">
                                    {{ $slider->subtitle }}
                                </h4>
                            @endif
                            
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" 
                                data-wow-delay="0.3s">
                                {{ $slider->title }}
                            </h1>
                            
                            @if($slider->description)
                                <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">
                                    {{ $slider->description }}
                                </p>
                            @endif
                            
                            @if($slider->button_text && $slider->button_link)
                                <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" 
                                   data-wow-delay="0.7s" 
                                   href="{{ $slider->button_link }}">
                                    {{ $slider->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    {{-- Fallback: Static Slider if no data --}}
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('website/img/carousel-1.png') }}" 
                                 class="img-fluid w-100" 
                                 alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" 
                                data-wow-delay="0.1s" 
                                style="letter-spacing: 3px;">
                                Save Up To A $400
                            </h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" 
                                data-wow-delay="0.3s">
                                On Selected Laptops & Desktop Or Smartphone
                            </h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">
                                Terms and Condition Apply
                            </p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" 
                               data-wow-delay="0.7s" 
                               href="#">
                                Shop Now
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
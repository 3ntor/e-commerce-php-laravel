@php $mainImage = $product->images->first(); @endphp
<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="product-item rounded wow fadeInUp">
        <div class="product-item-inner border rounded">
            <div class="product-item-inner-item">
                @if($mainImage)
                    <img src="{{ asset('storage/' . $mainImage->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                @if($product->is_new)
                    <div class="product-new">New</div>
                @elseif($product->is_featured)
                    <div class="product-sale">Featured</div>
                @endif
                <div class="product-details">
                    <a href="{{ route('products.productDetails', $product->id) }}"><i class="fa fa-eye fa-1x"></i></a>
                </div>
            </div>
            <div class="text-center rounded-bottom p-4">
                <a href="#" class="d-block mb-2">{{ $product->category->name ?? '' }}</a>
                <a href="{{ route('products.productDetails', $product->id) }}" class="d-block h4">{{ $product->name }}</a>
                @if($product->old_price)
                    <del class="me-2 fs-5">${{ $product->old_price }}</del>
                @endif
                <span class="text-primary fs-5">${{ $product->price }}</span>
            </div>

            {{-- الفورم لإضافة المنتج للكارت --}}
            <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                    </button>
                </form>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                            <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                        </a>
                        <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0">
                            <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

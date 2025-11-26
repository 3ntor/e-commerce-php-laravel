<div class="tab-class py-4">
    <div class="row align-items-center mb-4">
        <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
            <h2 class="mb-0">Our Products</h2>
        </div>
        <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex flex-wrap justify-content-end" id="productTabs" role="tablist">
                <li class="nav-item mb-2 me-2" role="presentation">
                    <button class="nav-link active rounded-pill py-1 px-3" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab">All Products</button>
                </li>
                <li class="nav-item mb-2 me-2" role="presentation">
                    <button class="nav-link rounded-pill py-1 px-3" id="new-tab" data-bs-toggle="pill" data-bs-target="#new" type="button" role="tab">New Arrivals</button>
                </li>
                <li class="nav-item mb-2 me-2" role="presentation">
                    <button class="nav-link rounded-pill py-1 px-3" id="featured-tab" data-bs-toggle="pill" data-bs-target="#featured" type="button" role="tab">Featured</button>
                </li>
                <li class="nav-item mb-2 me-2" role="presentation">
                    <button class="nav-link rounded-pill py-1 px-3" id="top-selling-tab" data-bs-toggle="pill" data-bs-target="#top-selling" type="button" role="tab">Top Selling</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="productTabsContent">

        <!-- All Products -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <div class="row g-4">
                @forelse($products as $product)
                    @include('website.sections.product-card', ['product' => $product])
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No products found</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- New Arrivals -->
        <div class="tab-pane fade" id="new" role="tabpanel">
            <div class="row g-4">
                @forelse($products->sortByDesc('created_at')->take(4) as $product)
                    @include('website.sections.product-card', ['product' => $product])
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No new products</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Featured (Random Products) -->
        <div class="tab-pane fade" id="featured" role="tabpanel">
            <div class="row g-4">
                @forelse($products->shuffle()->take(4) as $product)
                    @include('website.sections.product-card', ['product' => $product])
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No featured products</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Top Selling (Oldest Products as example) -->
        <div class="tab-pane fade" id="top-selling" role="tabpanel">
            <div class="row g-4">
                @forelse($products->sortBy('created_at')->take(4) as $product)
                    @include('website.sections.product-card', ['product' => $product])
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No top selling products</h4>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
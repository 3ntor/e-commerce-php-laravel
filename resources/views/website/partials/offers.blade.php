<!-- Products Offer Start -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row g-4">
@forelse(($offers ?? []) as $index => $offer)
                <div class="col-lg-6 wow {{ $index % 2 == 0 ? 'fadeInLeft' : 'fadeInRight' }}" 
                     data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                    <a href="{{ $offer->button_link ?? '#' }}" 
                       class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            @if($offer->description)
                                <p class="text-muted mb-3">{{ $offer->description }}</p>
                            @endif
                            
                            <h3 class="text-primary">{{ $offer->title }}</h3>
                            
                            <h1 class="display-3 text-secondary mb-0">
                                {{ $offer->discount_text }}
                            </h1>
                        </div>
                        
                        @if($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}" 
                                 class="img-fluid" 
                                 alt="{{ $offer->title }}"
                                 style="max-width: 200px; max-height: 200px; object-fit: contain;">
                        @endif
                    </a>
                </div>
            @empty
               
            @endforelse
        </div>
    </div>
</div>
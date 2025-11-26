<!-- Services Start -->
<div class="container-fluid px-0">
    <div class="row g-0">
@forelse(($services ?? []) as $index => $service)
            <div class="col-6 col-md-4 col-lg-2 {{ $index == 0 ? 'border-start' : '' }} border-end wow fadeInUp" 
                 data-wow-delay="{{ 0.1 + ($index * 0.1) }}s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fas {{ $service->icon }} fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">{{ $service->title }}</h6>
                            <p class="mb-0">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
           
        @endforelse
    </div>
</div>
<!-- Services End -->
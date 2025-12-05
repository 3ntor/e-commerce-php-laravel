@extends('layouts.website.app')

@section('title', 'Order Success')

@section('content')
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp">Order Confirmed!</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
        <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Order Success</li>
    </ol>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center p-5">
                    
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <h2 class="text-success mb-4">{{ session('success') }}</h2>
                    @else
                        <h2 class="text-success mb-4">Thank You for Your Order!</h2>
                    @endif

                    <p class="lead mb-4">
                        Your order has been successfully placed and is being processed.
                    </p>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>What's Next?</strong><br>
                        You will receive an email confirmation shortly with your order details.
                        We'll notify you when your order is shipped!
                    </div>

                    <!-- Order Info -->
                    <div class="my-4">
                        <p class="mb-2">
                            <strong>Order Status:</strong> 
                            <span class="badge bg-warning text-dark">Pending</span>
                        </p>
                        <p class="text-muted">
                            <small>You can track your order status from the admin panel</small>
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-5">
                        <a href="{{ route('website.home') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <a href="{{ route('products.products') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
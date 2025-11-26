@extends('layouts.website.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">المنتجات الأحدث</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p class="fw-bold">{{ $product->price }} EGP</p>
                            <a href="{{ route('website.product.details', $product->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

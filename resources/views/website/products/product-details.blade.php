@extends('layouts.website.app')

@section('title', $product->name)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
         @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                    class="card-img-top" 
                                    alt="{{ $product->name }}">
                                @endif        </div>
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>
            <p class="text-muted">{{ $product->price }} EGP</p>
            <p>{{ $product->description }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                    </button>
                </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.website.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
@include('website.partials.slider')
@include('website.partials.banner')
@include('website.partials.services')
@include('website.partials.offers')
<div class="container-fluid product py-5">
    <div class="container py-5">
        
        @if($categories->count() > 0)
            <ul>

            </ul>
        @else
            <p>لا توجد أصناف</p>
        @endif

        {{-- <h2>المنتجات:</h2>
        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                    class="card-img-top" 
                                    alt="{{ $product->name }}">
                                @endif
                            <div class="card-body">
                                <h5>{{ $product->name }}</h5>
                                <p>{{ $product->price }} جنيه</p>
                                <a href="{{ route('products.productDetails', $product->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>لا توجد منتجات</p>
        @endif --}}
        @include('website.sections.products-section')
    </div>
</div>

@endsection
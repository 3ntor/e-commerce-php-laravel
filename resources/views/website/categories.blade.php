@extends('layouts.website.app')

@section('title', 'الأصناف')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">كل الأصناف</h2>

    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="text-muted">{{ $category->description }}</p>
                        <a href="{{ route('website.productsByCategory', $category->id) }}" class="btn btn-outline-primary">عرض المنتجات</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

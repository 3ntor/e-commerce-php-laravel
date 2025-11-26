@extends('layouts.admin.app') 

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>تفاصيل الشريحة</h3>
        </div>
        <div class="card-body">
            <p><strong>العنوان:</strong> {{ $slider->title }}</p>
            <p><strong>العنوان الفرعي:</strong> {{ $slider->subtitle }}</p>
            <p><strong>الوصف:</strong> {{ $slider->description }}</p>
            <p><strong>زر:</strong> {{ $slider->button_text }}</p>
            <p><strong>رابط الزر:</strong> {{ $slider->button_link }}</p>
            <p><strong>الترتيب:</strong> {{ $slider->order }}</p>
            <p><strong>مفعل:</strong> {{ $slider->is_active ? 'نعم' : 'لا' }}</p>
            @if($slider->image)
                <div class="mt-3">
                    <img src="{{ asset('storage/'.$slider->image) }}" alt="صورة الشريحة" style="max-width: 400px;">
                </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary">رجوع للقائمة</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($offer) ? 'تعديل عرض' : 'إضافة عرض جديد' }}</h3>
    </div>

    <form action="{{ isset($offer) ? route('admin.offers.update', $offer->id) : route('admin.offers.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($offer))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group">
                <label for="title">العنوان <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" 
                       value="{{ old('title', $offer->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $offer->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">الصورة <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*" {{ !isset($offer) ? 'required' : '' }}>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if(isset($offer) && $offer->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $offer->image) }}" 
                             alt="{{ $offer->title }}" 
                             class="img-thumbnail" 
                             style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount_text">نص الخصم (مثل: 40% Off) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('discount_text') is-invalid @enderror" 
                               id="discount_text" name="discount_text" 
                               value="{{ old('discount_text', $offer->discount_text ?? '') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount_percentage">نسبة الخصم (%)</label>
                        <input type="number" class="form-control" 
                               id="discount_percentage" name="discount_percentage" 
                               min="0" max="100"
                               value="{{ old('discount_percentage', $offer->discount_percentage ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_text">نص الزر</label>
                        <input type="text" class="form-control" 
                               id="button_text" name="button_text" 
                               value="{{ old('button_text', $offer->button_text ?? 'Shop Now') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_link">رابط الزر</label>
                        <input type="url" class="form-control" 
                               id="button_link" name="button_link" 
                               value="{{ old('button_link', $offer->button_link ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">الترتيب</label>
                        <input type="number" class="form-control" 
                               id="order" name="order" 
                               value="{{ old('order', $offer->order ?? 0) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $offer->is_active ?? true) ? 'checked' : '' }}>
                            مفعل
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($offer) ? 'تحديث' : 'إضافة' }}
            </button>
            <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">إلغاء</a>
        </div>
    </form>
</div>
@endsection
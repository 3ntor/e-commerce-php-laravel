@extends('layouts.admin.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($slider) ? 'تعديل شريحة' : 'إضافة شريحة جديدة' }}</h3>
    </div>

<form action="{{ isset($slider) ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
        @csrf
        @if(isset($slider))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group">
                <label for="title">العنوان <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" 
                       value="{{ old('title', $slider->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subtitle">العنوان الثانوي</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                       id="subtitle" name="subtitle" 
                       value="{{ old('subtitle', $slider->subtitle ?? '') }}">
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $slider->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">الصورة <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*" {{ !isset($slider) ? 'required' : '' }}>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if(isset($slider) && $slider->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $slider->image) }}" 
                             alt="{{ $slider->title }}" 
                             class="img-thumbnail" 
                             style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_text">نص الزر</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                               id="button_text" name="button_text" 
                               value="{{ old('button_text', $slider->button_text ?? 'Shop Now') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_link">رابط الزر</label>
                        <input type="url" class="form-control @error('button_link') is-invalid @enderror" 
                               id="button_link" name="button_link" 
                               value="{{ old('button_link', $slider->button_link ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">الترتيب</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" 
                               value="{{ old('order', $slider->order ?? 0) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_active">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                            مفعل
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($slider) ? 'تحديث' : 'إضافة' }}
            </button>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">إلغاء</a>
        </div>
    </form>
</div>
@endsection
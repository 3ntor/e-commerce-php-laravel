@extends('layouts.admin.app')

@section('content')
<div class="content p-3">

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">تعديل المنتج: {{ $product->name }}</h3>
    </div>

<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

      <div class="card-body">
        <div class="form-group">
          <label>الاسم</label>
          <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
          <label>السعر</label>
          <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
          <label>الوصف</label>
          <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
          <label>الصنف</label>
          <select name="category_id" class="form-control" required>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" {{ $c->id == $product->category_id ? 'selected' : '' }}>
                {{ $c->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>الصور الحالية</label>
          <div class="d-flex flex-wrap">
            @foreach($product->images as $img)
              <div class="text-center me-2 mb-2" style="width:90px;">
                <img src="{{ asset('storage/'.$img->image_path) }}" class="img-thumbnail mb-1" width="80" height="80">
           <button type="button" class="btn btn-danger btn-sm w-100"
        onclick="deleteImage({{ $img->id }})">
    حذف
</button>

              </div>
            @endforeach
          </div>
        </div>

        <div class="form-group">
          <label>إضافة صور جديدة</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="images[]" multiple class="custom-file-input" id="productImages">
              <label class="custom-file-label" for="productImages">اختر صور</label>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
      </div>
    </form>
  </div>

</div>
@endsection

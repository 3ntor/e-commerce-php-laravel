@extends('layouts.admin.app')

@section('content')
<div class="content p-3">

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">إضافة منتج جديد</h3>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="card-body">
        {{-- الاسم --}}
        <div class="form-group">
          <label>اسم المنتج</label>
          <input type="text" name="name" class="form-control" placeholder="أدخل اسم المنتج" required>
        </div>

        {{-- السعر --}}
        <div class="form-group">
          <label>السعر</label>
          <input type="number" step="0.01" name="price" class="form-control" placeholder="أدخل السعر" required>
        </div>

        {{-- الوصف --}}
        <div class="form-group">
          <label>الوصف</label>
          <textarea name="description" class="form-control" rows="3" placeholder="أدخل وصف المنتج"></textarea>
        </div>

        {{-- الصنف --}}
        <div class="form-group">
          <label>الصنف</label>
          <select name="category_id" class="form-control" required>
            <option value="">اختر الصنف</option>
            @foreach($categories as $c)
              <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- الصور --}}
        <div class="form-group">
          <label for="productImages">صور المنتج (يمكن اختيار أكثر من صورة)</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="images[]" class="custom-file-input" id="productImages" multiple>
              <label class="custom-file-label" for="productImages">اختر الصور</label>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
      </div>
    </form>
  </div>

</div>
@endsection

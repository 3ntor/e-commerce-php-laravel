@extends('layouts.admin.app')

@section('content')

<div class="content p-4">

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">تعديل الصنف: {{ $category->name }}</h3>
    </div>
<form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="card-body">
    <div class="form-group mb-3">
      <label>الاسم</label>
      <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
    </div>

    <div class="form-group mb-3">
      <label>الفئة الرئيسية</label>
      <select name="parent_id" class="form-control">
        <option value="">بدون</option>
        @foreach($parents as $p)
          <option value="{{ $p->id }}" {{ $p->id == $category->parent_id ? 'selected' : '' }}>
            {{ $p->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group mb-3">
      <label>الصورة الحالية</label><br>
      @if($category->image)
        <img src="{{ asset('storage/'.$category->image) }}" width="120" class="mb-2 rounded">
      @else
        <p class="text-muted">لا توجد صورة حالياً</p>
      @endif
      <div class="input-group mt-2">
        <div class="custom-file">
          <input type="file" name="image" class="custom-file-input" id="categoryImage">
          <label class="custom-file-label" for="categoryImage">اختر صورة جديدة</label>
        </div>
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-between">
    <button type="submit" class="btn btn-primary">تحديث</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
  </div>
</form>

  </div>

</div>
@endsection

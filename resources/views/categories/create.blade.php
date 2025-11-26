@extends('layouts.admin.app')

@section('content')
<div class="content p-3">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">إضافة صنف جديد</h3>
                </div>

                <!-- form start -->
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">اسم الصنف</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="اكتب اسم الصنف" required>
                        </div>

                        <div class="form-group">
                            <label for="parent_id">الفئة الرئيسية (اختياري)</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">بدون</option>
                                @foreach($parents as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">صورة الصنف</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">اختر الصورة</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">رفع</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

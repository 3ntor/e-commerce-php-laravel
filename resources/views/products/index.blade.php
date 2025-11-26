@extends('layouts.admin.app')

@section('content')
<div class="content p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>المنتجات</h4>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة منتج
            </a>
            <a href="{{ route('products.trash') }}" class="btn btn-dark">
                <i class="fas fa-trash"></i> سلة المحذوفات
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">اسم المنتج</label>
                    <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="ابحث بالاسم...">
                </div>
      <div class="col-md-4">
    <label class="form-label">الصنف</label>
    <input list="categories" name="category_name" class="form-control" placeholder="اكتب أو اختر الصنف">
    <datalist id="categories">
        @foreach($categories as $cat)
            <option value="{{ $cat->name }}"></option>
        @endforeach
    </datalist>
</div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">بحث</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>

    @if($products->count() > 0)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">قائمة المنتجات</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>الصنف</th>
                        <th>الوصف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($p->images->count() > 0)
                                <img src="{{ asset('storage/'.$p->images->first()->image_path) }}" 
                                     width="60" height="60" 
                                     style="object-fit: cover; border-radius: 6px;">
                            @else
                                <img src="https://via.placeholder.com/60x60?text=No+Image" 
                                     width="60" height="60" 
                                     style="object-fit: cover; border-radius: 6px;">
                            @endif
                        </td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->price }} جنيه</td>
                        <td>{{ $p->category?->name ?? '-' }}</td>
                        <td class="text-truncate" style="max-width: 200px;">
                            {{ $p->description ?? 'لا يوجد وصف' }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-primary">
                                تعديل
                            </a>
                            <form action="{{ route('products.destroy', $p) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('هل تريد حذف المنتج؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

<div class="card-footer clearfix">
    <div class="float-right">
        {!! $products->appends(request()->query())->onEachSide(1)->links() !!}
    </div>
</div>
<div>
    @else
        <div class="alert alert-info text-center">لا توجد منتجات حالياً.</div>
    @endif
</div>
@endsection

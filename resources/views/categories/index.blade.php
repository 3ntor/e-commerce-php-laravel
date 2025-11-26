@extends('layouts.admin.app')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">كل الأصناف</h4>
    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة صنف
        </a>
        <a href="{{ route('categories.trash') }}" class="btn btn-dark">
            <i class="fas fa-trash"></i> سلة المحذوفات
        </a>
    </div>
</div>

{{-- رسائل نجاح / خطأ --}}
@if (session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

{{-- جدول الأصناف --}}
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h3 class="card-title mb-0">قائمة الأصناف</h3>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-bordered text-center align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>الاسم</th>
                    <th>الفئة الرئيسية</th>
                    <th>المستخدم</th>
                    <th>الصورة</th>
                    <th style="width: 180px;">التحكم</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $cat)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    {{-- الاسم مع لينك لمنتجات الصنف --}}
                    <td>
                        <a href="{{ route('products.index', ['category_id' => $cat->id]) }}" class="text-dark fw-bold">
                            {{ $cat->name }}
                        </a>
                    </td>

                    <td>{{ $cat->parent ? $cat->parent->name : 'صنف رئيسي' }}</td>
                    <td>{{ $cat->user?->name ?? '—' }}</td>

                    {{-- الصورة --}}
                    <td>
                        <a href="{{ route('products.index', ['category_id' => $cat->id]) }}">
                            @if($cat->image)
                                <img src="{{ asset('storage/'.$cat->image) }}" alt="صورة" width="60" height="60"
                                     style="object-fit:cover; border-radius:6px;">
                            @else
                                <img src="{{ asset('dist/img/no-image.png') }}" alt="no image" width="60" height="60"
                                     style="opacity:0.6;">
                            @endif
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('هل أنت متأكد من الحذف؟')" class="btn btn-sm btn-danger">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">لا توجد أصناف حالياً</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ترقيم الصفحات --}}
    <div class="card-footer clearfix">
        {{ $categories->links() }}
    </div>
</div>
@endsection

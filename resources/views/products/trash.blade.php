@extends('layouts.admin.app')

@section('content')
<div class="content p-3">
    <h4>سلة المحذوفات - المنتجات</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>السعر</th>
                <th>الفئة</th>
                <th>تاريخ الحذف</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->category->name ?? '-' }}</td>
                <td>{{ $p->deleted_at }}</td>
                <td>
                    <form action="{{ route('products.restore',$p->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-primary">استرجاع</button>
                    </form>

                    <form action="{{ route('products.forceDelete',$p->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('حذف نهائي؟')" class="btn btn-sm btn-dark">حذف نهائي</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection

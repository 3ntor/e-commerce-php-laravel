@extends('layouts.admin.app')

@section('content')
<div class="content p-3">
    <h4>سلة المحذوفات - الأصناف</h4>

    <table class="table table-bordered">
        <thead><tr><th>ID</th><th>الاسم</th><th>حذف بتاريخ</th><th>إجراءات</th></tr></thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->deleted_at }}</td>
                <td>
                    <form action="{{ route('categories.restore',$cat->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-primary">استرجاع</button>
                    </form>

                    <form action="{{ route('categories.forceDelete',$cat->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('حذف نهائي؟')" class="btn btn-sm btn-dark">حذف نهائي</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection

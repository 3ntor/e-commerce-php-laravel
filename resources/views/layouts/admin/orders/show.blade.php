@extends('layouts.admin.app')

@section('title', 'تفاصيل الطلب #' . $order->id)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">تفاصيل الطلب #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">الطلبات</a></li>
                    <li class="breadcrumb-item active">تفاصيل الطلب</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="row">
            
            <!-- معلومات الطلب -->
            <div class="col-md-8">
                
                <!-- بيانات العميل -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title"><i class="fas fa-user"></i> بيانات العميل</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>الاسم:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                                <p><strong>الشركة:</strong> {{ $order->company ?? 'غير محدد' }}</p>
                                <p><strong>العنوان:</strong> {{ $order->address }}</p>
                                <p><strong>المدينة:</strong> {{ $order->city }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>الدولة:</strong> {{ $order->country }}</p>
                                <p><strong>الرمز البريدي:</strong> {{ $order->zipcode }}</p>
                                <p><strong>الموبايل:</strong> {{ $order->mobile }}</p>
                                <p><strong>الإيميل:</strong> {{ $order->email }}</p>
                            </div>
                        </div>
                        @if($order->notes)
                            <hr>
                            <p><strong>ملاحظات:</strong></p>
                            <p class="text-muted">{{ $order->notes }}</p>
                        @endif
                    </div>
                </div>

                <!-- المنتجات -->
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title"><i class="fas fa-shopping-bag"></i> المنتجات المطلوبة</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الإجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product->name ?? 'منتج محذوف' }}</strong>
                                            @if($item->product)
                                                <br>
                                                <small class="text-muted">SKU: {{ $item->product->id }}</small>
                                            @endif
                                        </td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td><strong>${{ number_format($item->total, 2) }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>المجموع الفرعي:</strong></td>
                                    <td><strong>${{ number_format($order->subtotal, 2) }}</strong></td>
                                </tr>
                                @if($order->discount > 0)
                                <tr>
                                    <td colspan="3" class="text-right"><strong>الخصم:</strong></td>
                                    <td class="text-success"><strong>- ${{ number_format($order->discount, 2) }}</strong></td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-right"><strong>الشحن:</strong></td>
                                    <td><strong>${{ number_format($order->shipping, 2) }}</strong></td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="3" class="text-right"><h5><strong>الإجمالي النهائي:</strong></h5></td>
                                    <td><h5><strong>${{ number_format($order->total, 2) }}</strong></h5></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                
                <!-- حالة الطلب -->
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> معلومات الطلب</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>رقم الطلب:</strong> #{{ $order->id }}</p>
                        <p><strong>التاريخ:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                        <p><strong>طريقة الدفع:</strong> 
                            @switch($order->payment_method)
                                @case('bank') تحويل بنكي @break
                                @case('cod') الدفع عند الاستلام @break
                                @case('paypal') PayPal @break
                                @case('check') شيك @break
                                @default {{ $order->payment_method }}
                            @endswitch
                        </p>
                        <p><strong>طريقة الشحن:</strong> {{ $order->shipping_method ?? 'قياسي' }}</p>
                        <hr>
                        <p><strong>الحالة الحالية:</strong></p>
                        <h4>
                            <span class="badge badge-{{ $order->status_badge }}">
                                {{ $order->status_label }}
                            </span>
                        </h4>
                    </div>
                </div>

                <!-- تحديث الحالة -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> تحديث حالة الطلب</h3>
                    </div>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>اختر الحالة الجديدة:</label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                        قيد الانتظار
                                    </option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                        قيد التجهيز
                                    </option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                        تم الشحن
                                    </option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                        تم التسليم
                                    </option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                        ملغي
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-save"></i> حفظ التحديث
                            </button>
                        </div>
                    </form>
                </div>

                <!-- إجراءات -->
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left"></i> العودة للطلبات
                        </a>
                        
                        <button onclick="window.print()" class="btn btn-info btn-block">
                            <i class="fas fa-print"></i> طباعة الطلب
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection
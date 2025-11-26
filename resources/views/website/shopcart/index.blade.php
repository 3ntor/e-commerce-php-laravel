@extends('layouts.website.app')

@section('title', 'Cart Page - Electro')
@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp">Cart Page</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
        <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart Page</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp

                    @forelse($cart as $item)
                        @php
                            $lineTotal = $item['price'] * $item['quantity'];
                            $subtotal += $lineTotal;
                        @endphp
                        <tr data-product-id="{{ $item['id'] }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-1">{{ $item['name'] }}</p>
                                        <small class="text-muted">SKU: {{ $item['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item['model'] ?? '-' }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <div class="input-group quantity" style="width: 110px;">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-action="decrease"><i class="fa fa-minus"></i></button>
                                    <input type="text" class="form-control form-control-sm text-center border-0 qty-input" value="{{ $item['quantity'] }}" data-product-id="{{ $item['id'] }}">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-action="increase"><i class="fa fa-plus"></i></button>
                                </div>
                            </td>
                            <td class="line-total">${{ number_format($lineTotal, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.clear') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-md rounded-circle bg-light border" data-product-id="{{ $item['id'] }}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h5 class="text-muted">Your cart is empty</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Coupon & Clear Cart -->
        <div class="mt-3 d-flex align-items-center">
<form class="me-3" id="coupon-form" method="POST" action="{{ route('cart.coupon') }}">
    @csrf
    <input type="text" name="coupon" class="border-0 border-bottom rounded me-2 py-2" placeholder="Coupon Code">
    <button class="btn btn-primary rounded-pill px-4 py-2" type="submit">Apply Coupon</button>
</form>

            <form method="POST" action="{{ route('cart.clear') }}">
                @csrf
                <button id="clear-cart-btn" class="btn btn-outline-secondary rounded-pill px-4 py-2" type="submit">Clear Cart</button>
            </form>
        </div>

        <!-- Cart Summary -->
        <div class="row g-4 justify-content-end mt-4">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h3 class="mb-4">Cart <span class="fw-normal">Total</span></h3>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="mb-0 me-4">Subtotal:</h6>
                            <p id="subtotal" class="mb-0">${{ number_format($subtotal, 2) }}</p>
                        </div>

                        @if($discount > 0)
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="mb-0 me-4">Discount ({{ $couponCode ?? '' }}):</h6>
                            <p id="discount" class="mb-0 text-success">- ${{ number_format($discount, 2) }}</p>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0 me-4">Shipping</h6>
                            <p id="shipping" class="mb-0">${{ number_format($shipping, 2) }}</p>
                        </div>
                        <p  class="mb-0 text-end">Shipping to your address.</p>
                    </div>

                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p id="total" class="mb-0 pe-4">${{ number_format($total, 2) }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // --- تحديث الكمية ---
    function updateQty(productId, qty, row) {
        fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId, quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                // تحديث قيمة خط المنتج
                row.querySelector('.line-total').textContent = '$' + data.line_total.toFixed(2);
                // تحديث القيم الكلية
                updateCartTotals(data);
            } else {
                alert(data.message || 'Error updating cart');
            }
        })
        .catch(err => console.error(err));
    }

    function updateCartTotals(data) {
        document.querySelector('#subtotal').textContent = '$' + data.subtotal.toFixed(2);
        document.querySelector('#discount').textContent = '- $' + data.discount.toFixed(2);
        document.querySelector('#shipping').textContent = '$' + data.shipping.toFixed(2);
        document.querySelector('#total').textContent = '$' + data.total.toFixed(2);
    }

    document.querySelectorAll('.quantity').forEach(wrapper => {
        const input = wrapper.querySelector('.qty-input');
        const minus = wrapper.querySelector('[data-action="decrease"]');
        const plus = wrapper.querySelector('[data-action="increase"]');

        minus?.addEventListener('click', () => {
            let val = Math.max(1, parseInt(input.value) - 1);
            input.value = val;
            updateQty(input.dataset.productId, val, wrapper.closest('tr'));
        });

        plus?.addEventListener('click', () => {
            let val = parseInt(input.value) + 1;
            input.value = val;
            updateQty(input.dataset.productId, val, wrapper.closest('tr'));
        });

        input.addEventListener('blur', () => {
            let val = parseInt(input.value);
            if(!val || val < 1) val = 1;
            input.value = val;
            updateQty(input.dataset.productId, val, wrapper.closest('tr'));
        });
    });

    // --- إزالة منتج ---
    document.querySelectorAll('.remove-item-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            const productId = this.dataset.productId;

            fetch("{{ route('cart.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    row.remove();
                    updateCartTotals(data);
                } else {
                    alert(data.message || 'Error removing item');
                }
            });
        });
    });

    // --- مسح الكارت ---
    document.querySelector('#clear-cart-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        fetch("{{ route('cart.clear') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                document.querySelector('tbody').innerHTML = '<tr><td colspan="6" class="text-center py-5">Your cart is empty</td></tr>';
                updateCartTotals(data);
            }
        });
    });

    // --- تطبيق كوبون ---
    document.querySelector('#coupon-form')?.addEventListener('submit', function(e){
        e.preventDefault();
        const couponInput = this.querySelector('input[name="coupon"]').value;

        fetch("{{ route('cart.coupon') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ coupon: couponInput })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                alert('Coupon applied!');
                location.reload(); // أو ممكن تحدث القيم مباشرة إذا حابب بدون reload
            } else {
                alert(data.message || 'Invalid coupon');
            }
        });
    });

});

</script>
@endpush

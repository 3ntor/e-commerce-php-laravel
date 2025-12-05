@extends('layouts.website.app')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">
            CheckOut Page
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shopcart.index') }}">Cart</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>

@include('website.partials.services')

<div class="container-fluid bg-light overflow-hidden py-5">
    <div class="container py-5">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.1s">Billing details</h1>

        <!-- تعديل الـ Form Action -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="row g-5">

                <!-- LEFT SIDE -->
                <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Company Name</label>
                        <input type="text" name="company" class="form-control" value="{{ old('company') }}">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Address<sup>*</sup></label>
                        <input type="text" name="address" class="form-control" placeholder="House Number Street Name" value="{{ old('address') }}" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" name="country" class="form-control" value="{{ old('country') }}" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode') }}" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <hr>

                    <div class="form-item">
                        <label class="form-label my-3">Order Notes (Optional)</label>
                        <textarea name="notes" class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start">Name</th>
                                    <th>Model</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($cart as $item)
                                    @php
                                        $lineTotal = $item['price'] * $item['quantity'];
                                    @endphp

                                    <tr class="text-center">
                                        <th scope="row" class="text-start py-4">
                                            {{ $item['name'] }}
                                        </th>

                                        <td class="py-4">{{ $item['model'] ?? '-' }}</td>

                                        <td class="py-4">
                                            ${{ number_format($item['price'], 2) }}
                                        </td>

                                        <td class="py-4">
                                            {{ $item['quantity'] }}
                                        </td>

                                        <td class="py-4">
                                            ${{ number_format($lineTotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Subtotal -->
                                <tr>
                                    <td colspan="3"></td>

                                    <td class="py-4">
                                        <p class="mb-0 text-dark py-2">Subtotal</p>
                                    </td>

                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                ${{ number_format($subtotal, 2) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                @if($discount > 0)
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="py-4">
                                        <p class="mb-0 text-success py-2">Discount</p>
                                    </td>
                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-success">
                                                - ${{ number_format($discount, 2) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                @endif

                                <!-- SHIPPING -->
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="py-4">
                                        <p class="mb-0 text-dark py-2">Shipping</p>
                                    </td>
                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                ${{ number_format($shipping, 2) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                <!-- TOTAL -->
                                <tr>
                                    <td colspan="3"></td>

                                    <td class="py-4">
                                        <p class="mb-0 text-dark text-uppercase py-2"><strong>TOTAL</strong></p>
                                    </td>

                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                <strong>${{ number_format($total, 2) }}</strong>
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- SHIPPING METHOD (Hidden input - backend will use default) -->
                    <input type="hidden" name="shipping_method" value="standard">

                    <!-- PAYMENT METHODS -->
                    <div class="mb-3">
                        <h5 class="mb-3">Payment Method <span class="text-danger">*</span></h5>

                        <div class="form-check mb-3">
                            <input type="radio" name="payment_method" class="form-check-input" value="bank" id="payment-bank" required>
                            <label class="form-check-label" for="payment-bank">
                                <strong>Direct Bank Transfer</strong>
                            </label>
                            <p class="text-muted small ms-4">
                                Make your payment directly into our bank account. Your order will be shipped after confirmation.
                            </p>
                        </div>

                        <div class="form-check mb-3">
                            <input type="radio" name="payment_method" class="form-check-input" value="check" id="payment-check">
                            <label class="form-check-label" for="payment-check">
                                <strong>Check Payments</strong>
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="radio" name="payment_method" class="form-check-input" value="cod" id="payment-cod">
                            <label class="form-check-label" for="payment-cod">
                                <strong>Cash On Delivery</strong>
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="radio" name="payment_method" class="form-check-input" value="paypal" id="payment-paypal">
                            <label class="form-check-label" for="payment-paypal">
                                <strong>PayPal</strong>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-100">
                            <i class="fas fa-check-circle me-2"></i> Place Order
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection
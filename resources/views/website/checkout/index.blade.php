@extends('layouts.website.app')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">
            @if(isset($search) && $search)
                Search Results for "{{ $search }}"
            @elseif(isset($category))
                {{ $category->name }}
            @else
                CheckOut Page
            @endif
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Products</li>
        </ol>
    </div>
@include('website.partials.services')

<div class="container-fluid bg-light overflow-hidden py-5">
    <div class="container py-5">

        <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.1s">Billing details</h1>

        <form action="#">

            <div class="row g-5">

                <!-- LEFT SIDE -->
                <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Address<sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="House Number Street Name">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control">
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div>

                    <hr>

                    <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Address-1">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div>

                    <div class="form-item">
                        <textarea class="form-control" rows="8" placeholder="Order Notes (Optional)"></textarea>
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

                                @php
                                    $subtotal = 0;
                                @endphp

                                @foreach($cart as $item)
                                    @php
                                        $lineTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $lineTotal;
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
                                    <td></td>
                                    <td></td>
                                    <td></td>

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

                                <!-- SHIPPING OPTIONS -->
                                <tr>
                                    <td></td>
                                    <td class="py-4">
                                        <p class="mb-0 text-dark py-4">Shipping</p>
                                    </td>

                                    <td colspan="3" class="py-4">

                                        <div class="form-check text-start">
                                            <input type="radio" name="shipping" class="form-check-input bg-primary" value="0">
                                            <label class="form-check-label">Free Shipping</label>
                                        </div>

                                        <div class="form-check text-start">
                                            <input type="radio" name="shipping" class="form-check-input bg-primary" value="15">
                                            <label class="form-check-label">Flat rate: $15.00</label>
                                        </div>

                                        <div class="form-check text-start">
                                            <input type="radio" name="shipping" class="form-check-input bg-primary" value="8">
                                            <label class="form-check-label">Local Pickup: $8.00</label>
                                        </div>

                                    </td>
                                </tr>

                                <!-- TOTAL -->
                                @php
                                    $total = $subtotal; // shipping added later by JS or backend
                                @endphp

                                <tr>
                                    <td></td>

                                    <td class="py-4">
                                        <p class="mb-0 text-dark text-uppercase py-2">TOTAL</p>
                                    </td>

                                    <td></td>
                                    <td></td>

                                    <td class="py-4">
                                        <div class="py-2 text-center border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                ${{ number_format($total, 2) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- PAYMENT METHODS -->
                    <div class="row g-0 text-center align-items-center justify-content-center border-bottom py-2">
                        <div class="col-12">
                            <div class="form-check text-start my-2">
                                <input type="radio" name="payment" class="form-check-input bg-primary" value="bank">
                                <label class="form-check-label">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">
                                Make your payment directly into our bank account. Your order will be shipped after confirmation.
                            </p>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                        <div class="col-12">
                            <div class="form-check text-start my-2">
                                <input type="radio" name="payment" class="form-check-input bg-primary" value="check">
                                <label class="form-check-label">Check Payments</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                        <div class="col-12">
                            <div class="form-check text-start my-2">
                                <input type="radio" name="payment" class="form-check-input bg-primary" value="cod">
                                <label class="form-check-label">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                        <div class="col-12">
                            <div class="form-check text-start my-2">
                                <input type="radio" name="payment" class="form-check-input bg-primary" value="paypal">
                                <label class="form-check-label">Paypal</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button" class="btn btn-primary py-3 px-4 w-100">
                            Place Order
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection

<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // عرض صفحة الكارت
    public function index()
    {
        $cart = session()->get('cart', []);
        $coupon = session()->get('cart_coupon', null);

        $subtotal = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        $discount = 0;
        $couponCode = null;
        if ($coupon) {
            $couponCode = $coupon['code'] ?? null;
            if (($coupon['type'] ?? null) === 'percent') {
                $discount = round($subtotal * ($coupon['value'] / 100), 2);
            } elseif (($coupon['type'] ?? null) === 'fixed') {
                $discount = min($subtotal, $coupon['value']);
            }
        }

        $shipping = session()->get('cart_shipping', 3.00); // شحن ثابت كمثال
        $total = round($subtotal - $discount + $shipping, 2);

        return view('website.shopcart.index', compact('cart', 'subtotal', 'discount', 'shipping', 'total', 'couponCode'));
    }

    // إضافة منتج للكارت
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'model' => $product->model ?? null,
                'price' => (float) $product->price,
                'image' => $product->image ? asset('storage/' . $product->image) : asset('website/img/placeholder.jpg'),
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart.');
    }

    // تحديث كمية منتج في الكارت (AJAX أو form)
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $pid = $request->product_id;

        if (!isset($cart[$pid])) {
            return response()->json(['status' => 'error', 'message' => 'Product not in cart.'], 404);
        }

        $cart[$pid]['quantity'] = (int)$request->quantity;
        session()->put('cart', $cart);

        $subtotal = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        return response()->json([
        'status' => 'success',
        'line_total' => $lineTotal,
        'subtotal' => $subtotal,
        'discount' => $discount ?? 0,
        'shipping' => $shipping ?? 0,
        'total' => $total,
        ]);
    }

    // إزالة منتج من الكارت
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = session()->get('cart', []);
        $pid = $request->product_id;

        if (isset($cart[$pid])) {
            unset($cart[$pid]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart.');
    }

    // تطبيق كوبون
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string'
        ]);

        $code = strtoupper(trim($request->coupon));

        $available = [
            'SAVE10' => ['type' => 'percent', 'value' => 10],
            'FLAT5'  => ['type' => 'fixed', 'value' => 5],
        ];

        if (!isset($available[$code])) {
            return back()->with('error', 'Invalid coupon code.');
        }

        session()->put('cart_coupon', array_merge(['code' => $code], $available[$code]));
        return back()->with('success', 'Coupon applied.');
    }
    // مسح الكارت بالكامل
    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_coupon');
        return back()->with('success', 'Cart cleared.');
    }
}

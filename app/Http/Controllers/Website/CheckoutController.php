<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // عرض صفحة الـ Checkout
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shopcart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $shipping = 15; // قيمة ثابتة أو ممكن نخليها ديناميك
        $total = $subtotal + $shipping;

        return view('website.checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }


    // عمل الأوردر وتخزينه في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'address'    => 'required|string',
            'city'       => 'required|string',
            'country'    => 'required|string',
            'zipcode'    => 'required|string',
            'mobile'     => 'required|string',
            'email'      => 'required|email',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Cart is empty!');
        }

        // حساب المبالغ
        $subtotal = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $shipping = 15;
        $total = $subtotal + $shipping;

        // إنشاء الأوردر
        $order = Order::create([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'company'        => $request->company,
            'address'        => $request->address,
            'city'           => $request->city,
            'country'        => $request->country,
            'zipcode'        => $request->zipcode,
            'mobile'         => $request->mobile,
            'email'          => $request->email,
            'notes'          => $request->notes,
            'shipping_method'=> $request->shipping_method ?? 'standard',
            'payment_method' => $request->payment_method,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
        ]);

        // إضافة المنتجات داخل order_items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['quantity'],
            ]);
        }

        // بعد تسجيل الأوردر نفضي الكارت
        session()->forget('cart');

        return redirect()->route('checkout.success')->with('success', 'Your order has been placed!');
    }


    // صفحة النجاح
    public function success()
    {
        return view('website.checkout.success');
    }
}

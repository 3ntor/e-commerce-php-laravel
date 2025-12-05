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

        $shipping = session()->get('cart_shipping', 3.00);
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

        // التحقق من المخزون
        if ($product->stock < $qty) {
            return back()->with('error', 'الكمية المطلوبة غير متوفرة في المخزون!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['quantity'] + $qty;
            
            // التحقق من المخزون عند الزيادة
            if ($product->stock < $newQty) {
                return back()->with('error', 'لا يمكن إضافة هذه الكمية. المتوفر: ' . $product->stock);
            }
            
            $cart[$product->id]['quantity'] = $newQty;
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

        return back()->with('success', 'تم إضافة المنتج إلى السلة بنجاح!');
    }

    // تحديث كمية منتج في الكارت (AJAX)
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

        // التحقق من المخزون
        $product = Product::find($pid);
        if (!$product || $product->stock < $request->quantity) {
            return response()->json([
                'status' => 'error', 
                'message' => 'الكمية المطلوبة غير متوفرة!'
            ], 400);
        }

        // تحديث الكمية
        $cart[$pid]['quantity'] = (int)$request->quantity;
        session()->put('cart', $cart);

        // حساب الإجماليات
        $subtotal = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        
        $coupon = session()->get('cart_coupon', null);
        $discount = 0;
        if ($coupon) {
            if (($coupon['type'] ?? null) === 'percent') {
                $discount = round($subtotal * ($coupon['value'] / 100), 2);
            } elseif (($coupon['type'] ?? null) === 'fixed') {
                $discount = min($subtotal, $coupon['value']);
            }
        }

        $shipping = session()->get('cart_shipping', 3.00);
        $total = round($subtotal - $discount + $shipping, 2);
        
        $lineTotal = $cart[$pid]['price'] * $cart[$pid]['quantity'];

        return response()->json([
            'status' => 'success',
            'line_total' => number_format($lineTotal, 2),
            'subtotal' => number_format($subtotal, 2),
            'discount' => number_format($discount, 2),
            'shipping' => number_format($shipping, 2),
            'total' => number_format($total, 2),
        ]);
    }

    // إزالة منتج من الكارت (AJAX)
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

        // حساب الإجماليات بعد الحذف
        $subtotal = collect($cart)->reduce(fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        
        $coupon = session()->get('cart_coupon', null);
        $discount = 0;
        if ($coupon) {
            if (($coupon['type'] ?? null) === 'percent') {
                $discount = round($subtotal * ($coupon['value'] / 100), 2);
            } elseif (($coupon['type'] ?? null) === 'fixed') {
                $discount = min($subtotal, $coupon['value']);
            }
        }

        $shipping = session()->get('cart_shipping', 3.00);
        $total = round($subtotal - $discount + $shipping, 2);

        return response()->json([
            'status' => 'success',
            'subtotal' => number_format($subtotal, 2),
            'discount' => number_format($discount, 2),
            'shipping' => number_format($shipping, 2),
            'total' => number_format($total, 2),
            'message' => 'تم إزالة المنتج من السلة.'
        ]);
    }

    // تطبيق كوبون (AJAX)
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
            return response()->json([
                'status' => 'error',
                'message' => 'كود الخصم غير صحيح.'
            ], 400);
        }

        session()->put('cart_coupon', array_merge(['code' => $code], $available[$code]));
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم تطبيق كود الخصم بنجاح!'
        ]);
    }

    // مسح الكارت بالكامل (AJAX)
    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_coupon');
        
        return response()->json([
            'status' => 'success',
            'message' => 'تم مسح السلة بالكامل.'
        ]);
    }
}
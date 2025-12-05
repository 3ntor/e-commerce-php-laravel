<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // عرض صفحة الـ Checkout
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shopcart.index')->with('error', 'السلة فارغة!');
        }

        // التحقق من توفر المنتجات
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product) {
                return redirect()->route('shopcart.index')
                    ->with('error', "المنتج {$item['name']} غير موجود!");
            }
            if ($product->stock < $item['quantity']) {
                return redirect()->route('shopcart.index')
                    ->with('error', "المنتج {$item['name']} متوفر فقط {$product->stock} قطعة!");
            }
        }

        $subtotal = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        
        $coupon = session()->get('cart_coupon', null);
        $discount = 0;
        if ($coupon) {
            if (($coupon['type'] ?? null) === 'percent') {
                $discount = round($subtotal * ($coupon['value'] / 100), 2);
            } elseif (($coupon['type'] ?? null) === 'fixed') {
                $discount = min($subtotal, $coupon['value']);
            }
        }
        
        $shipping = 15;
        $total = round($subtotal - $discount + $shipping, 2);

        return view('website.checkout.index', compact('cart', 'subtotal', 'discount', 'shipping', 'total'));
    }

    // عمل الأوردر وتخزينه في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'required|string',
            'city'       => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'zipcode'    => 'required|string|max:20',
            'mobile'     => 'required|string|max:20',
            'email'      => 'required|email|max:255',
            'payment_method' => 'required|string|in:bank,check,cod,paypal',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'السلة فارغة!');
        }

        // استخدام Transaction عشان نضمن تنفيذ كل العمليات أو لا حاجة
        DB::beginTransaction();
        
        try {
            // التحقق من المخزون مرة تانية
            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->find($item['id']);
                
                if (!$product) {
                    throw new \Exception("المنتج {$item['name']} غير موجود!");
                }
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("المنتج {$item['name']} متوفر فقط {$product->stock} قطعة!");
                }
            }

            // حساب المبالغ
            $subtotal = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
            
            $coupon = session()->get('cart_coupon', null);
            $discount = 0;
            if ($coupon) {
                if (($coupon['type'] ?? null) === 'percent') {
                    $discount = round($subtotal * ($coupon['value'] / 100), 2);
                } elseif (($coupon['type'] ?? null) === 'fixed') {
                    $discount = min($subtotal, $coupon['value']);
                }
            }
            
            $shipping = 15;
            $total = round($subtotal - $discount + $shipping, 2);

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
                'discount'       => $discount,
                'shipping'       => $shipping,
                'total'          => $total,
                'status'         => 'pending',
            ]);

            // إضافة المنتجات + تقليل المخزون
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                    'total'      => $item['price'] * $item['quantity'],
                ]);

                // تقليل المخزون
                $product = Product::find($item['id']);
                $product->decrement('stock', $item['quantity']);
            }

            // مسح الكارت والكوبون
            session()->forget(['cart', 'cart_coupon', 'cart_shipping']);

            DB::commit();

            return redirect()->route('checkout.success')
                           ->with('success', 'تم تقديم طلبك بنجاح! رقم الطلب: #' . $order->id);
                           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // صفحة النجاح
    public function success()
    {
        return view('website.checkout.success');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // عرض كل الطلبات
    public function index(Request $request)
    {
        $query = Order::with('items.product')->latest();

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // بحث بالإيميل أو الموبايل
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15);
        
        return view('layouts.admin.orders.index', compact('orders'));
    }

    // عرض تفاصيل طلب واحد
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('layouts.admin.orders.show', compact('order'));
    }

    // تحديث حالة الطلب
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }

    // حذف طلب (اختياري)
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // إرجاع الكمية للمخزون قبل الحذف
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }

        $order->delete();
        
        return redirect()->route('admin.orders.index')
                        ->with('success', 'تم حذف الطلب وإرجاع المنتجات للمخزون');
    }
}
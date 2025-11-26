<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض المنتجات مع البحث
    public function index()
    {
        $query = Product::with(['category', 'images']);

        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->filled('category_name')) {
            $query->whereHas('category', function ($q) {
                $q->where('name', 'like', '%' . request('category_name') . '%');
            });
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // إنشاء منتج جديد
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // حفظ المنتج الجديد
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id'     => 3,
        ]);

        // حفظ الصور لو موجودة
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح.');
    }

    // تعديل منتج
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images', 'category');

        return view('products.edit', compact('product', 'categories'));
    }

    // تحديث بيانات المنتج
  public function update(UpdateProductRequest $request, $id)
{
    $product = Product::withTrashed()->findOrFail($id);

    $product->update([
        'name'        => $request->name,
        'price'       => $request->price,
        'description' => $request->description,
        'category_id' => $request->category_id,
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }
    }

    return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح.');
}


    // حذف مؤقت (Soft Delete)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج مؤقتاً.');
    }

    // عرض سلة المحذوفات
    public function trash()
    {
        $products = Product::onlyTrashed()->with('category', 'user')->paginate(15);
        return view('products.trash', compact('products'));
    }

    // استرجاع منتج محذوف
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trash')->with('success', 'تم استرجاع المنتج.');
    }

    // حذف نهائي
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }

        $product->forceDelete();
        return redirect()->route('products.trash')->with('success', 'تم حذف المنتج نهائياً.');
    }

    // حذف صورة واحدة من المنتج
    public function deleteImage($id)
    {
        $img = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($img->image_path);
        $img->delete();
        return back()->with('success', 'تم حذف الصورة.');
    }

    
}

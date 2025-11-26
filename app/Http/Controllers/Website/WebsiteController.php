<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
public function home() {
    $categories = Category::withCount('products')->get();
    $products = Product::latest()->get(); // 
    $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get(); 
    $banner = \App\Models\Banner::where('is_active', true)->first(); 
    $offers = \App\Models\Offer::where('is_active', true)->orderBy('order')->take(2)->get(); 
    $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get(); 
    return view('website.home', compact('products', 'categories', 'sliders', 'banner' ,'offers', 'services'));
}

    public function products(Request $request) {
        $categories = Category::withCount('products')->get(); // للنافبار
        
        $query = Product::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }
        
        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        $products = $query->paginate(12);
        
        return view('website.products.products', compact('products', 'categories'));
    }

    public function categoriesPage() {
        $categories = Category::withCount('products')->get();
        return view('website.categories', compact('categories'));
    }

    public function productDetails($id) {
        $categories = Category::withCount('products')->get(); // للنافبار
        $product = Product::findOrFail($id);
        return view('website.products.product-details', compact('product', 'categories'));
    }

    public function productsByCategory($id) {
        $categories = Category::withCount('products')->get(); // للنافبار
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        return view('website.products', compact('products', 'category', 'categories'));
    }
    
    public function search(Request $request) {
        $categories = Category::withCount('products')->get();
        
        $search = $request->input('search');
        $category_id = $request->input('category_id');
        
        $query = Product::query();
        
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }
        
        if ($category_id && $category_id != 'All Category') {
            $query->where('category_id', $category_id);
        }
        
        $products = $query->paginate(10);
        
        return view('website.products', compact('products', 'categories', 'search','offers', 'services'));
    }

    // ========== NEW: Get products by filter (AJAX) ==========
    public function getProducts(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        $products = match($filter) {
            'new' => Product::where('is_new', true)->latest()->take(8)->get(),
            'featured' => Product::where('is_featured', true)->latest()->take(8)->get(),
            'top-selling' => Product::orderBy('sales_count', 'desc')->take(8)->get(),
            default => Product::latest()->take(8)->get(),
        };
        
        return response()->json([
            'products' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image ? asset('storage/' . $product->image) : asset('website/img/placeholder.jpg'),
                    'category' => $product->category->name ?? 'Uncategorized',
                    'price' => number_format($product->price, 2),
                    'old_price' => $product->old_price ? number_format($product->old_price, 2) : null,
                    'is_new' => $product->is_new,
                    'is_featured' => $product->is_featured,
                    'url' => route('website.productDetails', $product->id)
                ];
            })
        ]);
    }
}
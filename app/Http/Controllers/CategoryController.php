<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $categories = Category::with('parent')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? null,
            'image' => $path,
            'user_id' => 3,
        ]);

        return redirect()->route('categories.index')->with('success', 'تم إضافة الصنف بنجاح.');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'تم تعديل الصنف بنجاح.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'لا يمكن حذف هذا الصنف لأنه يحتوي على منتجات. احذف المنتجات أولاً.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تم حذف الصنف مؤقتاً.');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->with('parent')->paginate(15);
        return view('categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.trash')->with('success', 'تم استرجاع الصنف.');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->forceDelete();

        return redirect()->route('categories.trash')->with('success', 'تم حذف الصنف نهائياً.');
    }
}

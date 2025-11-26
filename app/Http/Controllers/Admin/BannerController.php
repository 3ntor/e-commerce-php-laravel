<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->paginate(10);
        return view('layouts.admin.partials.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('layouts.admin.partials.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'offer_text' => 'nullable|string|max:100',
            'offer_label' => 'nullable|string|max:100',
            'product_name' => 'nullable|string|max:255',
            'old_price' => 'nullable|numeric|min:0',
            'new_price' => 'nullable|numeric|min:0',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'تم إنشاء البانر بنجاح!');
    }

    public function edit(Banner $banner)
    {
        return view('layouts.admin.partials.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'offer_text' => 'nullable|string|max:100',
            'offer_label' => 'nullable|string|max:100',
            'product_name' => 'nullable|string|max:255',
            'old_price' => 'nullable|numeric|min:0',
            'new_price' => 'nullable|numeric|min:0',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'تم تحديث البانر بنجاح!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'تم حذف البانر بنجاح!');
    }
}
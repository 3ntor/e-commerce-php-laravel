<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::orderBy('order')->paginate(10);
        return view('layouts.admin.partials.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('layouts.admin.partials.offers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_text' => 'required|string|max:100',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('offers', 'public');
            $validated['image'] = $imagePath;
        }

        Offer::create($validated);

        return redirect()->route('admin.offers.index')->with('success', 'تم إنشاء العرض بنجاح!');
    }

    public function edit(Offer $offer)
    {
        return view('layouts.admin.partials.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_text' => 'required|string|max:100',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $imagePath = $request->file('image')->store('offers', 'public');
            $validated['image'] = $imagePath;
        }

        $offer->update($validated);

        return redirect()->route('admin.offers.index')->with('success', 'تم تحديث العرض بنجاح!');
    }

    public function destroy(Offer $offer)
    {
        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }

        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', 'تم حذف العرض بنجاح!');
    }
}
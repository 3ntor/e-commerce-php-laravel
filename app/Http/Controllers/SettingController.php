<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting(); // لو مفيش سجل، يبقى كائن جديد
        return view('layouts.admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'website_name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website_link' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // لو مفيش سجل موجود، انشئ واحد جديد
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create($validated);
        } else {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                    Storage::disk('public')->delete($setting->logo);
                }

                $logoPath = $request->file('logo')->store('settings', 'public');
                $validated['logo'] = $logoPath;
            }

            $setting->update($validated);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}

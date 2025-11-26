<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // لو عندك صلاحيات تقدر تتحكم هنا
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم المنتج مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'category_id.required' => 'يجب اختيار الصنف.',
            'category_id.exists' => 'الصنف المحدد غير موجود.',
            'images.*.image' => 'يجب أن تكون الصور من نوع صورة.',
            'images.*.mimes' => 'يُسمح فقط بأنواع الصور: jpg، jpeg، png، gif.',
        ];
    }
}

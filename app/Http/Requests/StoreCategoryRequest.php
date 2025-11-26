<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // لو في صلاحيات لاحقاً ممكن تتحكم هنا
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الصنف مطلوب.',
            'name.max' => 'اسم الصنف لا يجب أن يتجاوز 255 حرفًا.',
            'parent_id.exists' => 'الصنف الأب المحدد غير موجود.',
            'image.image' => 'يجب أن يكون الملف صورة.',
            'image.mimes' => 'أنواع الصور المسموح بها: jpg، jpeg، png، gif.',
            'image.max' => 'الحد الأقصى لحجم الصورة هو 4 ميجابايت.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
            'parent_id.exists' => 'الصنف الأب المحدد غير موجود.',
            'image.image' => 'يجب أن يكون الملف صورة.',
            'image.mimes' => 'أنواع الصور المسموح بها: jpg، jpeg، png، gif.',
        ];
    }
}

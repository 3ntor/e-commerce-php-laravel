<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'old_price',        // ← جديد
        'description',
        'category_id',
        'user_id',
        'image',            // ← إضافة
        'stock',            // ← إضافة
        'model',            // ← إضافة
        'is_featured',      // ← جديد
        'sales_count',      // ← جديد
        'is_new'            // ← جديد
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
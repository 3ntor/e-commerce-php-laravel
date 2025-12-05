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
        'old_price',
        'description',
        'category_id',
        'user_id',
        'image',
        'stock',            // ← إضافة الكمية
        'model',
        'is_featured',
        'sales_count',
        'is_new'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'stock' => 'integer',
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

    // علاقة مع OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
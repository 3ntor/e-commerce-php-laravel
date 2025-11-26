<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'image', 'offer_text', 'offer_label', 'product_name', 'old_price', 'new_price', 'button_text', 'button_link', 'order', 'is_active'];
}
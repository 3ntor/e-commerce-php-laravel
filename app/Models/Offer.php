<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'description', 'image', 'discount_text', 'discount_percentage', 'button_text', 'button_link', 'order', 'is_active'];
}
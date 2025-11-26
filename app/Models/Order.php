<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company', 'address', 'city', 'country',
        'zipcode', 'mobile', 'email', 'notes',
        'shipping_method', 'payment_method',
        'subtotal', 'shipping', 'total'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}


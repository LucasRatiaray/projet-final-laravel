<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'status',
        'total_price',
        'created_at',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductOrders extends Pivot
{
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'unit_price'
    ];
}

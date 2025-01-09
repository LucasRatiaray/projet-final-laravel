<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'width',
        'height',
        'depth',
        'category_id',
        'image_url',
        'in_stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

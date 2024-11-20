<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = ['product_id', 'stock', 'warning_stock', 'product_sell_price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

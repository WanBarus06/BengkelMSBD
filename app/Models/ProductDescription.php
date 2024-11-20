<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    protected $fillable = ['size_id', 'brand_id', 'variant_id', 'product_description', 'product_photo'];

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'description_id'];

    public function productDescription()
    {
        return $this->hasOne(ProductDescription::class, 'description_id', 'description_id');
    }

    // Relasi satu ke satu (One-to-One) dengan ProductDetail
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'product_id');
    }

}

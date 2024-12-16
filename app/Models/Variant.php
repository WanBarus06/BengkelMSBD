<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = ['variant_name'];

    public function productDescription()
    {
        return $this->hasOne(ProductDescription::class, 'product_id', 'product_id');
    }
}

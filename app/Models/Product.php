<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'description_id'];

    public function description()
    {
        return $this->belongsTo(ProductDescription::class, 'description_id');
    }

}

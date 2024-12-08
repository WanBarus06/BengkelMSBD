<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price_per_unit',
    ];

    // Accessor untuk total_price
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->price_per_unit;
    }
}

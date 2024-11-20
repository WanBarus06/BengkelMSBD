<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceDetail extends Model
{
    protected $fillable = ['invoice_id', 'product_id', 'quantity', 'unit_price'];

    public function invoice()
    {
        return $this->belongsTo(PurchaseInvoice::class, 'invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

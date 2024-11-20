<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $fillable = ['invoice_date', 'supplier_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function details()
    {
        return $this->hasMany(PurchaseInvoiceDetail::class, 'invoice_id');
    }
}

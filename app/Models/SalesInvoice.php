<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_name',
        'invoice_date',
        'total_amount',
        'status',
        'transaction_type',
    ];

    public function details()
    {
        return $this->hasMany(SalesInvoiceDetail::class, 'invoice_id');
    }

    // Opsional: Method untuk menghitung total amount di sales invoice
    public function calculateTotalAmount()
    {
        return $this->details->sum('total_price');
    }
}

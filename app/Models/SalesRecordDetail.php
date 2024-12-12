<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecordDetail extends Model
{
    protected $table = 'sales_record_details';

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'price_per_unit',
    ];

    public function salesRecord()
    {
        return $this->belongsTo(SalesRecord::class, 'sales_id', 'sales_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

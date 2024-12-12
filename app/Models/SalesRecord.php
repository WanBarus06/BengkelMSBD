<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    protected $table = 'sales_records';

    protected $primaryKey = 'sales_id';

    protected $fillable = [
        'customer_id',
        'offline_customer_name',
        'offline_customer_phone_number',
        'offline_customer_address',
        'is_fully_paid',
    ];

    public function details()
    {
        return $this->hasMany(SalesRecordDetail::class, 'sales_id', 'sales_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}

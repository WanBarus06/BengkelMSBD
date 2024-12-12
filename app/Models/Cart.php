<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'cancelled_by',
        'cancelled_reason',
        'failed_at',
        'remarks',
    ];

    /**
     * Relasi dengan tabel User (pemilik cart)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan User yang membatalkan cart (admin/staff)
     */
    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    /**
     * Relasi dengan CartItems (produk dalam cart)
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    } 
    
    public function getTotalPriceAttribute()
    {
        return DB::selectOne('SELECT purchase_invoice_detail_total(?) as total', [$this->id])->total;
    }

    
}
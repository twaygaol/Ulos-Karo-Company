<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status',
        'snap_token',
        'payment_status'
    ];

    protected $casts = [
        'total_price' => 'float'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi langsung ke product (untuk memudahkan dashboard)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Method untuk mendapatkan produk pertama (karena mungkin ada banyak items)
    public function getFirstProductAttribute()
    {
        return $this->items->first()->product ?? null;
    }
}
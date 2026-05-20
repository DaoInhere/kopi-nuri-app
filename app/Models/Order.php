<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['kasir_id', 'meja_id', 'total_harga', 'status_pesanan'];

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
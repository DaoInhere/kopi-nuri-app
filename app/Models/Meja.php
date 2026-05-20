<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_meja', 'status'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
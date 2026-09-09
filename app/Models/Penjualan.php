<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    
    // Tambahkan uang_masuk dan uang_kembalian ke dalam array fillable ini
    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'uang_masuk',
        'uang_kembalian',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
}

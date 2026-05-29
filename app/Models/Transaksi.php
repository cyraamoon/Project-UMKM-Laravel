<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id', 'total_harga', 'metode_bayar', 'metode_kirim', 'items'
    ];

    protected $casts = [
        'items' => 'array', // otomatis convert json ke array
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}

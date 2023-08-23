<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturPembayaran extends Model
{
    use HasFactory;

    protected $table = 'StrukturPembayaran';

    protected $fillable = [
        'id',
        'nomor_transaksi',
        'tiket_id',
        'keranjang_id',
        'harga_tiket_id',
        'tanggal',
        'pembayaran',
        'nomor_virtual_account'
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }

    public function harga_tiket()
    {
        return $this->belongsTo(Harga_Tikets::class, 'harga_tiket_id');
    }
    protected $hidden = [
        'tiket_id',
        'harga_tiket_id',
        'keranjang_id',
        'created_at',
        'updated_at',
        'image',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'Pembayaran';

    protected $fillable = [
        'id',
        'tiket_id',
        'harga_tiket_id',
        'keranjang_id',
        'tanggal_pembelian',
        'stadiun'
    ];

    protected $hidden = [
        'tiket_id',
        'keranjang_id',
        'harga_tiket_id',
        'updated_at',
        'created_at',
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    public function tuan_rumah()
    {
        return $this->belongsTo(Tikets::class, 'tuan_rumah');
    }

    public function penantang()
    {
        return $this->belongsTo(Tikets::class, 'penantang');
    }

    public function harga_tiket()
    {
        return $this->belongsTo(Harga_Tikets::class, 'harga_tiket_id');
    }

    public function keranjang()
    {
        return $this->belongsTo(keranjang::class, 'keranjang_id');
    }
}
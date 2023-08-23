<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory; 

    protected $table = 'keranjang';

    protected $fillable = [
        'id',
        'harga_tiket_id',
        'harga',
        'tiket_id',
        'total',
        'jumlh_tiket',
        'tanggal_pembelian',
        'user_id',
        'Seat',
    ];

    public function harga_tiket()
    {
        return $this->belongsTo(Harga_Tikets::class, 'harga_tiket_id');
    }

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}

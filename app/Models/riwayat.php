<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat';

    protected $fillable =[
        'id',
        'tiket_id',
        'seat',
        'pembayaran'
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    protected $hidden =[
        'tiket_id',
        'created_at',
        'updated_at',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga_Tikets extends Model
{
    use HasFactory;

    protected $table = 'Harga_Tikets';

    protected $fillable = [
        'id',
        'tiket_id',
        'harga',
        'jenis_tiket_id'
    ];

    protected $hidden=[
        'image',
        'keterangan',
        'stadiun',
        'jenis_tiket_id',
        'created_at',
        'updated_at'
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    public function jenis_tiket()
    {
        return $this->belongsTo(Jenis_Tikets::class, 'jenis_tiket_id');
    }
}

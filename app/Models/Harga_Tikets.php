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
}

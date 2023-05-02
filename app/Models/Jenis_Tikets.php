<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Tikets extends Model
{
    use HasFactory;

    protected $table = 'Jenis_Tikets';

    protected $fillable = [
        'id',
        'nama',
        'keterangan'
    ];

    protected $hidden=[
        'id',
        'keterangan',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim_Persik extends Model
{
    use HasFactory;
    
    protected $table = 'tim_persik';

    protected $fillable =[
        'nama',
        'keterangan',
        'kewarganegaraan',
        'is_aktif',
        'url_logo',
        'pemain',
        'posisi_pemain'
    ];

    protected $hidden=[
        'id',
        'is_aktif',
        'kewarganegaraan',
        'keterangan',
        'created_at',
        'updated_at'
    ];
}

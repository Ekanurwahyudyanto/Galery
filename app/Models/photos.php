<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photos extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $fillable =[
        'id',
        'galery_pertandingan_id',
        'path',
        'is_default'
    ];

    protected $hidden=[
        'id',
        'galery_pertandingan_id',
        'is_default',
        'created_at',
        'updated_at'
    ];
}

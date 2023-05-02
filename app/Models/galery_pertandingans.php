<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galery_pertandingans extends Model
{
    use HasFactory;

    protected $table = 'galery_pertandingans';

    protected $fillable =[
        'id',
        'tiket_id'
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    protected $hidden=[
        'id',
        'galery_pertandingan_id',
        'stadiun',
        'is_default',
        'created_at',
        'updated_at'
    ];
}

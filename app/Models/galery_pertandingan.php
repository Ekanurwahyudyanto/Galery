<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galery_pertandingan extends Model
{
    use HasFactory;

    protected $table = 'galery_pertandingan';

    protected $fillable =[
        'id',
        'tiket_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim_ligas extends Model
{
    use HasFactory;

    protected $table = 'Tim_Ligas';

    protected $fillable = [
        'id',
        'nama',
        'stadiun',
        'keterangan',
        'image'
    ];

    protected $hidden=[
        'id',
        'tuan_rumah_id',
        'penantang_id',
        'keterangan',
        'stadiun',
        'created_at',
        'updated_at'
    ];

}

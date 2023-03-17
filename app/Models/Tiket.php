<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'Tiket';

    protected $fillable = [
        'id',
        'tuan_rumah_id',
        'penantang_id',
        'tanggal',
    ];
}

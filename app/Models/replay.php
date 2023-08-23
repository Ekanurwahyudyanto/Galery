<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class replay extends Model
{
    use HasFactory;

    protected $table = 'replay';

    protected $fillable =[
        'id',
        'tuan_rumah_id',
        'penantang_id'
    ];
}

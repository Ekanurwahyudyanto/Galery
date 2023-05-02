<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Google extends Model
{
    use HasFactory;

    protected $table = 'login_google';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'google_id',
        'password',
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_pertandingans extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pertandingans';

    protected $fillable =[
        'id',
        'tuan_rumah_id',
        'penantang_id',
        'tanggal',
        
    ];

    public function tuan_rumah()
    {
        return $this->belongsTo(Tim_ligas::class, 'tuan_rumah_id');
    }

    public function penantang()
    {
        return $this->belongsTo(Tim_ligas::class, 'penantang_id');
    }

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

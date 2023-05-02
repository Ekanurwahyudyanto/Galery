<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tikets extends Model
{
    use HasFactory;

    protected $table = 'Tikets';

    protected $fillable = [
        'id',
        'tuan_rumah_id',
        'penantang_id',
        'stadiun',
        'tanggal'
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
        'image',
        'tuan_rumah_id',
        'penantang_id',
        'created_at',
        'updated_at'
    ];
}

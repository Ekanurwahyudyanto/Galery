<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metode extends Model
{
    use HasFactory;

    protected $table = 'metode';

    protected $fillable = [
        'id',
        'tiket_id',
        'keranjang_id',
        'logo1',
        'logo2',
        'logo3',
        'logo4'
    ];

    public function tiket()
    {
        return $this->belongsTo(Tikets::class, 'tiket_id');
    }

    public function keranjang()
    {
        return $this->belongsTo(keranjang::class, 'keranjang_id');
    }
}

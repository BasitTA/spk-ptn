<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SawTopsis extends Model
{
    use HasFactory;

    // protected $fillable = ['id','matriks_x','max_x','normalisasi_matriks_r',
    // 'normalisasi_matriks_y',
    // 'solusi_ideal_positif',
    // 'solusi_ideal_negatif',
    // 'jarak_terbobot_a_positif',
    // 'jarak_terbobot_a_negatif',
    // 'nilai_preferensi'];

    protected $guarded = [];

    protected $casts = [
        'normalisasi_matriks_r' => 'array',
        'normalisasi_matriks_y' => 'array',
        'nilai_preferensi' => 'array',
    ];
}

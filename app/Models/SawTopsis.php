<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SawTopsis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'matriks_x' => 'array',
        'normalisasi_matriks_r' => 'array',
        'normalisasi_matriks_y' => 'array',
        'normalisasi_matriks_y' => 'array'
    ];
}

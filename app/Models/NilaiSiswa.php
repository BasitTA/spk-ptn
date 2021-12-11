<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'pilihan' => 'array'
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function kriteria(){
        return $this->hasMany(Kriteria::class);
    }
}

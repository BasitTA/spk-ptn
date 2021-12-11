<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nilaiSiswa(){
        return $this->hasOne(NilaiSiswa::class);
    }
    
    // public function kriteria(){
    //     return $this->hasOne(Kriteria::class);
    // }
}

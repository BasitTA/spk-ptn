<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model{

    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'pembobotan_kriteria' => 'array'
    ];

    public function nilaiSiswa(){
        return $this->belongsTo(NilaiSiswa::class);
    }

    // public function siswa(){
    //     return $this->belongsToMany(Siswa::class);
    // }
}

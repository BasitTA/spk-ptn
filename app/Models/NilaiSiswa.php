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


    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where(function($query) use ($search){
                $query->where('nama','like','%'.$search.'%');
            });
        });
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function kriteria(){
        return $this->hasMany(Kriteria::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where(function($query) use ($search){
                $query->where('nama','like','%'.$search.'%');
                    // ->orWhere('alamat','like','%'.$search.'%');
            });
        });
        // $query->when($filters['search'] ?? false, function($query, $abc){
        //     return $query->where(function($query) use ($abc){
        //         $query->where('nama','like','%'.$abc.'%');
        //             // ->orWhere('alamat','like','%'.$search.'%');
        //     });
        // });
        // if(request('search')){
        //     return $query->where('nama','like','%'.request('search').'%');
        // }
    }


    public function nilaiSiswa(){
        return $this->hasOne(NilaiSiswa::class);
    }
    
    // public function kriteria(){
    //     return $this->hasOne(Kriteria::class);
    // }
}

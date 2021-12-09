<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(){
        return view('konten/siswa/siswa',[
            "title" => "Siswa",
            "siswas" => Siswa::all() 
        ]);
    }

    public function show(Siswa $id){
        return view('konten/siswa/detailSiswa',[
            "title" => "Calon Siswa",
            "siswas" => $id
        ]);
    }

    public function createNilaiSiswa(){
        return view('konten/siswa/tambahNilaiSiswa',[
            "title" => "Tambah Nilai Siswa",
            "siswas" => Siswa::orderBy('nama')->get(),
            "kriterias" => Kriteria::all()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;


class NilaiController extends Controller
{
    public function index(){
        return view('konten.siswa.nilai.index',[
            'title' => 'Nilai Siswa',
            'siswas' => Siswa::latest()->get(),
            'nilai_siswas' => NilaiSiswa::latest()->filter(request(['search']))->get()
        ]);
    }

    // public function show(){
    //     return view('konten.siswa.nilai.show');
    // }

    public function create(){
        return view('konten.siswa.nilai.create',[
            'title' => 'Nilai Baru',
            'siswas' => Siswa::orderBy('nama')->get(),
            'kriterias' => Kriteria::all()
        ]);
    }
    
    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
            'nama' => 'required',
        ]);
    }
}

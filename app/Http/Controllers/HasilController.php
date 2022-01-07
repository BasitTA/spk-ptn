<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiSiswa;

class HasilController extends Controller
{
    public function index(){
        return view('konten.hasil perhitungan.index',[
            'title' => 'Hasil Perhitungan',
            'nilai_siswas' => NilaiSiswa::all()
        ]);
    }
}

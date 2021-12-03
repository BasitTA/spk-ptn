<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(){
        return view('siswa',[
            "title" => "Siswa",
            "siswas" => Siswa::all() 
        ]);
    }

    public function show(Siswa $id){
        return view('detailSiswa',[
            "title" => "Calon Siswa",
            "siswas" => $id
        ]);
    }
}

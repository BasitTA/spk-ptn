<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index(){
        return view('konten.kriteria.index',[
            'active' => 3,
            'title' => 'Data Kriteria',
            'kriterias' => Kriteria::all()
        ]);
    }
}

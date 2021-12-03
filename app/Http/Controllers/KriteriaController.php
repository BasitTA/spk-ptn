<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index(){
        return view('kriteria',[
            "title" => "Kriteria",
            "kriterias" => Kriteria::all()
        ]);
    }
}

<?php

use App\Models\Siswa;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('siswa',[
        "title" => "Siswa",
        "siswas" => Siswa::all() 
    ]);
});

Route::get('/siswa', function () {
    return view('siswa',[
        "title" => "Siswa",
        "siswas" => Siswa::all() 
    ]);
});

Route::get('/kriteria', function () {
    return view('kriteria',[
        "title" => "Kriteria",
        "kriterias" => Kriteria::all()
    ]);
});


Route::get('/hasilperhitungan', function () {
    return view('hasilPerhitungan',[
        "title" => "Hasil Perhitungan"
    ]);
});

Route::get('/siswa/daftarsiswa/{id}', function($id){
    return view('showDaftarSiswa',[
        "title" => "Calon Siswa",
        "siswas" => Siswa::find($id)
    ]);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RegisterController;

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
Route::fallback(function () {
    return Redirect::away('/');
});

Route::group(['middleware' => ['guest']], function(){
    //REGISTER
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
    
    //LOGIN & LOGOUT
    // Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::group(['middleware' => ['auth','cekuser:admin']], function(){ 
    Route::get('/siswa/siswabaru', [SiswaController::class, 'create'])->middleware('auth');
    Route::post('/siswa/siswabaru', [SiswaController::class, 'store'])->middleware('auth');
    Route::delete('/siswa/{id}-{nilai_siswa_id}', [SiswaController::class, 'destroy'])->middleware('auth');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->middleware('auth');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->middleware('auth');

    Route::get('/nilaisiswa/nilaibaru', [NilaiController::class, 'create'])->middleware('auth');
    Route::post('/nilaisiswa/nilaibaru', [NilaiController::class, 'store'])->middleware('auth');
    Route::delete('/nilaisiswa/{id}', [NilaiController::class, 'destroy'])->middleware('auth');
    Route::get('/nilaisiswa/{id}/edit', [NilaiController::class, 'edit'])->middleware('auth');
    Route::put('/nilaisiswa/{id}', [NilaiController::class, 'update'])->middleware('auth');
});

Route::group(['middleware' => ['auth','cekuser:admin,kepsek']], function(){
    //DATA SISWA
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/{id}', [SiswaController::class, 'show'])->middleware('auth');
    Route::get('/cetakdatasiswa', [SiswaController::class, 'print'])->middleware('auth');
    
    //NILAI SISWA
    Route::get('/nilaisiswa', [NilaiController::class, 'index'])->middleware('auth');
    Route::get('/cetaknilaisiswa', [NilaiController::class, 'print'])->middleware('auth');
    
    //KRITERIA
    Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware('auth');
    // Route::get('/kriteria/kriteriabaru', [KriteriaController::class, 'create'])->middleware('auth');
    // Route::post('/kriteria/kriteriabaru', [KriteriaController::class, 'store'])->middleware('auth');
    
    //HASIL PERHITUNGAN
    Route::get('/hasilperhitungan', [HasilController::class, 'index'])->middleware('auth');
    Route::get('/cetakhasilperhitungan', [HasilController::class, 'print'])->middleware('auth');
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::group(['middleware' => ['auth','cekuser:admin,kepsek,user']], function(){ 
    //HASIL PERHITUNGAN
    Route::get('/cetakhasilperhitungan', [HasilController::class, 'print']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

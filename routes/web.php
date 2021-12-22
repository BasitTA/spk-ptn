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

//REGISTER
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

//LOGIN & LOGOUT
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//DATA SISWA
Route::get('/', [SiswaController::class, 'index'])->middleware('auth');
Route::get('/siswa', [SiswaController::class, 'index'])->middleware('auth');
Route::get('/siswa/siswabaru', [SiswaController::class, 'create'])->middleware('auth');
Route::post('/siswa/siswabaru', [SiswaController::class, 'store'])->middleware('auth');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->middleware('auth');

//NILAI SISWA
Route::get('/nilaisiswa', [NilaiController::class, 'index'])->middleware('auth');
Route::get('/nilaisiswa/nilaibaru', [NilaiController::class, 'create'])->middleware('auth');
Route::post('/nilaisiswa/nilaibaru', [NilaiController::class, 'store'])->middleware('auth');

//KRITERIA
Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware('auth');

//HASIL PERHITUNGAN
// Route::get('/hasil', [HasilController::class, 'index']);
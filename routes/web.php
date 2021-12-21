<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
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

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

//
Route::get('/', [SiswaController::class, 'index'])->middleware('auth');
Route::get('/siswa', [SiswaController::class, 'index'])->middleware('auth');

Route::get('/siswa/siswabaru', [SiswaController::class, 'create'])->middleware('auth');
Route::post('/siswa/siswabaru', [SiswaController::class, 'store'])->middleware('auth');

Route::get('/siswa/detailsiswa/{id}', [SiswaController::class, 'show'])->middleware('auth');
Route::get('/siswa/nilaisiswa', [SiswaController::class, 'createNilaiSiswa'])->middleware('auth');

//
Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware('auth');


// Route::get('/hasil', [HasilController::class, 'index']);
//Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

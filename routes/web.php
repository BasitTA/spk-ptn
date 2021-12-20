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
Route::get('/', [SiswaController::class, 'index']);
Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswa/detailSiswa/{id}', [SiswaController::class, 'show']);
Route::get('/siswa/nilaisiswa', [SiswaController::class, 'createNilaiSiswa']);

//
Route::get('/kriteria', [KriteriaController::class, 'index']);


// Route::get('/hasil', [HasilController::class, 'index']);
//Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Siswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/absensi', [AbsenController::class, 'index']);
Route::post('/absensi/store', [AbsenController::class, 'store']);
Route::post('/absensi/update/{id}', [AbsenController::class, 'update']);
Route::get('/absensi/destroy/{id}', [AbsenController::class, 'destroy']);
Route::post('/absensi/filter', [AbsenController::class, 'filterDataByNama']);

//halaman login


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);



Route::get('/siswa', [SiswaController::class, 'index']);
Route::post('/siswa/store', [SiswaController::class, 'store']);
Route::post('/siswa/update/{id}', [SiswaController::class, 'update']);
Route::get('/siswa/destroy/{id}', [SiswaController::class, 'destroy']);

Route::post('/logout', [LoginController::class, 'logout']);

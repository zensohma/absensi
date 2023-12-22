<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginOperatorController;
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

Route::middleware('auth:siswa')->group(function(){
    Route::get('/absensi', [AbsenController::class, 'index']);
    Route::post('/absensi/store', [AbsenController::class, 'store']);
    Route::post('/absensi/update/{id}', [AbsenController::class, 'update']);
    Route::get('/absensi/destroy/{id}', [AbsenController::class, 'destroy']);
    Route::post('/absensi/filter', [AbsenController::class, 'filterDataByNama']);
});

Route::middleware('auth:operator')->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::post('/siswa/update/{id}', [SiswaController::class, 'update']);
    Route::get('/siswa/destroy/{id}', [SiswaController::class, 'destroy']);
    
    Route::get('/operator', [OperatorController::class, 'index']);
    Route::post('/operator/store', [OperatorController::class, 'store']);
    Route::post('/operator/update/{id}', [OperatorController::class, 'update']);
    Route::get('/operator/destroy/{id}', [OperatorController::class, 'destroy']);
    
    Route::get('/level', [LevelController::class, 'index']);
    Route::post('/level/store', [LevelController::class, 'store']);
    Route::post('/level/update/{id}', [LevelController::class, 'update']);
    Route::get('/level/destroy/{id}', [LevelController::class, 'destroy']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/loginoperator', [LoginOperatorController::class, 'index']);
    Route::post('/loginoperator', [LoginOperatorController::class, 'authenticate']);
    
});

Route::middleware('auth:operator')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::post('/logout', [LoginController::class, 'logout']);
});
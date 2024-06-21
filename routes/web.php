<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('barang',BarangController::class)->middleware('auth');
Route::resource('kategori',KategoriController::class)->middleware('auth');
Route::resource('barangkeluar',BarangKeluarController::class)->middleware('auth');
Route::resource('barangmasuk',BarangMasukController::class)->middleware('auth');
// Route::resource('dashboard',DashboardController::class)->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth'); 

Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class,'authenticate']);
Route::post('logout', [LoginController::class,'logout']);
Route::get('logout', [LoginController::class,'logout']);

Route::get('register', [RegisterController::class,'create'])->name('register');
Route::post('register', [RegisterController::class, 'store']);
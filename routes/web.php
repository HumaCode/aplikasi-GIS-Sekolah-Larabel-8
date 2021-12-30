<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;

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


// Frontend
Route::get('/', [WebController::class, 'index']);
Route::get('/kec/{id_kecamatan}', [WebController::class, 'kecamatan']);
Route::get('/jen/{id_jenjang}', [WebController::class, 'jenjang']);
Route::get('/detailsekolah/{id_sekolah}', [WebController::class, 'detailsekolah']);


// backend
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


// kecamatan
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::get('/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

// jenjang
Route::get('/jenjang', [JenjangController::class, 'index'])->name('jenjang');
Route::get('/jenjang/add', [JenjangController::class, 'add']);
Route::post('/jenjang/insert', [JenjangController::class, 'insert']);
Route::get('/jenjang/edit/{id_jenjang}', [JenjangController::class, 'edit']);
Route::post('/jenjang/update/{id_jenjang}', [JenjangController::class, 'update']);
Route::get('/jenjang/delete/{id_jenjang}', [JenjangController::class, 'delete']);

// Sekolah
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');
Route::get('/sekolah/add', [SekolahController::class, 'add']);
Route::post('/sekolah/insert', [SekolahController::class, 'insert']);
Route::get('/sekolah/edit/{id_sekolah}', [SekolahController::class, 'edit']);
Route::post('/sekolah/update/{id_sekolah}', [SekolahController::class, 'update']);
Route::get('/sekolah/delete/{id_sekolah}', [SekolahController::class, 'delete']);

// User
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);

// about
Route::get('/about', [AboutController::class, 'index'])->name('about');

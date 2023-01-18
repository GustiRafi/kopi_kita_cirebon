<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/tambah-karyawan',App\Http\Controllers\owner\KaryawanController::class)->middleware('auth');
Route::resource('/menu',App\Http\Controllers\owner\menuController::class)->middleware('auth');
Route::post('/tambah-meja', [App\Http\Controllers\owner\tableController::class, 'store'])->middleware('auth');
Route::post('/hapus-meja', [App\Http\Controllers\owner\tableController::class, 'delete'])->middleware('auth');
Route::get('/buat-pesanan',[App\Http\Controllers\waiter\pesanController::class, 'index'])->middleware('auth');
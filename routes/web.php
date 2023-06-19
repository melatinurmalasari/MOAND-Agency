<?php

use App\Http\Controllers\Auth\LupaPassword;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Dashboard\Eceran;
use App\Http\Controllers\Dashboard\OlehOleh;
use App\Http\Controllers\Dashboard\Reseller;
use Illuminate\Support\Facades\Route;

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

Route::controller(Login::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('isLogin');
    Route::post('/login', 'submitLogin');
    Route::get('/logout', 'logout');
});

Route::controller(LupaPassword::class)->middleware('isLogin')->group(function () {
    Route::get('/lupa-password', 'index');
});

Route::controller(Reseller::class)->middleware('auth')->group(function () {
    Route::get('/reseller', 'index');
    Route::post('/reseller/barang', 'submitTambahBarang');
    Route::put('/reseller/barang/{id}', 'submitEditBarang');
    Route::get('/reseller/barang', 'searchBarang');
    Route::post('/reseller/checkout', 'submitPesanan');
});

Route::controller(OlehOleh::class)->middleware('auth')->group(function () {
    Route::get('/oleh-oleh', 'index');
    Route::post('/oleh-oleh/barang', 'submitTambahBarang');
    Route::put('/oleh-oleh/barang/{id}', 'submitEditBarang');
    Route::get('/oleh-oleh/barang', 'searchBarang');
    Route::post('/oleh-oleh/checkout', 'submitPesanan');
});

Route::controller(Eceran::class)->middleware('auth')->group(function () {
    Route::get('/eceran', 'index');
    Route::post('/eceran/barang', 'submitTambahBarang');
    Route::put('/eceran/barang/{id}', 'submitEditBarang');
    Route::get('/eceran/barang', 'searchBarang');
    Route::post('/eceran/checkout', 'submitPesanan');
});

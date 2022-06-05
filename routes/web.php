<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\BarangController;


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

Route::get('/', fn() => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/satuan/data', [SatuanController::class,'data'])->name('satuan.data');
    Route::resource('/satuan', SatuanController::class);

    Route::get('/jenisbarang/data', [JenisBarangController::class,'data'])->name('jenisbarang.data');
    Route::resource('/jenisbarang', JenisBarangController::class);

    Route::get('/penyedia/data', [PenyediaController::class,'data'])->name('penyedia.data');
    Route::resource('/penyedia', PenyediaController::class);

    Route::get('/sumberdana/data', [SumberDanaController::class,'data'])->name('sumberdana.data');
    Route::resource('/sumberdana', SumberDanaController::class);

    Route::get('/pemohon/data', [PemohonController::class,'data'])->name('pemohon.data');
    Route::resource('/pemohon', PemohonController::class);

    Route::get('/barang/data', [BarangController::class,'data'])->name('barang.data');
    Route::resource('/barang', BarangController::class);
});

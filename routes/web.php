<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\SPPBController;
use App\Http\Controllers\ListBarangSPPBController;
use App\Http\Controllers\BASTController;
use App\Http\Controllers\ListBarangBASTController;
use App\Http\Controllers\profilSKPDController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\KartuPersediaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;



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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('home');
//     })->name('dashboard');
// });

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/404', function () {
                return view('admin.404');
            })->name('404');
    
    Route::group(['middleware' => 'level:1,3'],function(){
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

        Route::get('/penerimaanbarang/data', [PenerimaanBarangController::class,'data'])->name('penerimaanbarang.data');
        Route::get('/penerimaanbarang/cetaklistpdf', [PenerimaanBarangController::class, 'cetakListPDF'])->name('penerimaanbarang.cetaklist');
        Route::resource('/penerimaanbarang', PenerimaanBarangController::class);

        Route::get('/sppb/data', [SPPBController::class,'data'])->name('sppb.data');
        Route::get('/sppb/{id}/create', [SPPBController::class, 'create'])->name('sppb.create');
        Route::get('/sppb/pdf/{id}', [SPPBController::class, 'cetakpdf'])->name('sppb.cetakpdf');
        Route::resource('/sppb', SPPBController::class)
            ->except('create');

        Route::get('/sppblist/{id}/data', [ListBarangSPPBController::class, 'data'])->name('sppblist.data');
        // Route::get('/sppblist/loadform/{diskon}/{total}', [ListBarangSPPBController::class, 'loadForm'])->name('sppblist.loadform');
        // Route::put('/sppblist/updateket/{id}', [ListBarangSPPBController::class, 'updateket'])->name('sppblist.updateket');
        Route::resource('/sppblist', ListBarangSPPBController::class)
            ->except('create', 'show', 'edit');

        Route::get('/bast/data', [BASTController::class,'data'])->name('bast.data');
        Route::get('/bast/{id}/create', [BASTController::class, 'create'])->name('bast.create');
        Route::get('/bast/pdf/{id}', [BASTController::class, 'cetakpdf'])->name('bast.cetakpdf');
        Route::get('/bast/cetaklistpdf', [BASTController::class, 'cetakListPDF'])->name('bast.cetaklist');
        Route::resource('/bast', BASTController::class)
            ->except('create');

        Route::get('/bastlist/{id}/data', [ListBarangBASTController::class, 'data'])->name('bastlist.data');
        // Route::get('/sppblist/loadform/{diskon}/{total}', [ListBarangSPPBController::class, 'loadForm'])->name('sppblist.loadform');
        // Route::put('/sppblist/updateket/{id}', [ListBarangSPPBController::class, 'updateket'])->name('sppblist.updateket');
        Route::resource('/bastlist', ListBarangBASTController::class)
            ->except('create', 'show', 'edit');

        Route::get('/profilskpd', [profilSKPDController::class, 'index'])->name('profilskpd.index');
        Route::get('/profilskpd/first', [profilSKPDController::class, 'show'])->name('profilskpd.show');
        Route::post('/profilskpd', [profilSKPDController::class, 'update'])->name('profilskpd.update');

        Route::get('/user/data', [UserController::class,'data'])->name('user.data');
        Route::resource('/user', UserController::class);
    });
    

    Route::get('/stokopname', [StokOpnameController::class, 'index'])->name('stokopname.index');
    Route::get('/stokopname/data/{awal}/{akhir}/{kode}', [StokOpnameController::class, 'data'])->name('stokopname.data');
    Route::get('/stokopname/pdf/{awal}/{akhir}/{kode}', [StokOpnameController::class, 'exportPDF'])->name('stokopname.export_pdf');

    Route::get('/kartupersediaan', [KartuPersediaanController::class, 'index'])->name('kartupersediaan.index');
    Route::get('/kartupersediaan/data/{awal}/{akhir}/{kode}', [KartuPersediaanController::class, 'data'])->name('kartupersediaan.data');
    Route::get('/kartupersediaan/pdf/{awal}/{akhir}/{kode}', [KartuPersediaanController::class, 'exportPDF'])->name('kartupersediaan.export_pdf');

    
});

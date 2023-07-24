<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProsesController;
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
})->middleware('authAdmin');

Route::get('/dashboard', function () {
    return view('pages.dashboard', [
        'title' => 'Dashboard'
    ]);
    // wes a awkmu sek penasaran ? tak ndak ok
})->middleware('authAdmin');

Route::controller(CustomersController::class)->group(function () {
    Route::get('login', 'show');
    Route::post('login/attempt-login', 'attemptLogin');
    Route::get('logout', 'destroy');
});

Route::middleware(['authAdmin'])->group(function () {
    Route::controller(PagesController::class)->group(function () {
    
        Route::get('/dashboard', 'pageDashboard');
        Route::get('/master/data-aset', 'pageBarang');
        Route::get('/master/tambah-kat', 'tambahKat');
        Route::get('/data-barang/{noinventaris}', 'detailBarang');
        Route::get('/master/barang-masuk', 'barangMasuk');
        Route::get('/kelola-aset', 'kelolaAset');
        Route::get('/master/barang-masuk/data-baru', 'dataBaru');
        Route::get('/cetak/pdf', 'cetak_pdf');
        Route::get('/master/barang-masuk/priview', 'priviewPrint');
        Route::get('/formulir/pengajuan', 'formulir');
        Route::get('/formulir/daftar/po', 'daftarPO');
        Route::get('/formulir/daftar/aprov', 'aprovPurchaseOrder');
        Route::get('/formulir/laporan-pembelian', 'formulir');
        Route::get('/data-aset/barcode/{noinventaris}', 'barcode');
        Route::get('/pengaturan', 'pengaturan');
        Route::get('/pengaturan/tambah-pengguna', 'tambahPengguna');
        Route::get('/pengaturan/daftar-pengguna', 'daftarPengguna');
        Route::get('/pengaturan/ubah-password', 'ubahPassword');
        Route::get('/pengaturan/pengguna/{userid}/edit', 'editPengguna');
        Route::get('/pengaturan/pengguna/{userid}/hapus', 'hapusPengguna');
        
    });
    
    Route::controller(ProsesController::class)->group(function(){
        
        Route::post('pengaturan/tambah-pengguna', 'tambahPengguna');
        Route::post('pengaturan/daftar-pengguna', 'daftarPengguna');
        Route::post('pengaturan/pengguna/edit', 'editPengguna');
        Route::post('pengaturan/ubah-password', 'ubahPassword');
        Route::post('master/tambah-kat', 'tambahKategori');
        Route::post('master/hapusKategori', 'hapusKategori');
        Route::post('master/getKategori', 'ambilKat');
        Route::post('master/editKategori/{id_kategori}', 'editKategori');
        Route::post('data-barang/{noinventaris}/dist', 'postDistribusi');
        Route::post('data-baru/upload', 'postUpload');
        Route::post('data-baru/simpan-database', 'simpanDatabase');
        Route::post('formulir/simpan', 'simpanFormulir');
        Route::post('formulir/ajukan', 'ajukanFormulir');
        Route::post('formulir/daftar/aprov', 'aprovPurchaseOrder');
        Route::get('formulir/hapus/{id}', 'hapusFormulir');
        Route::get('formulir/terima/{id}', 'terimaFormulir');
        Route::get('data-master', 'dataMasterAset');
        Route::get('data-baru/import', 'importAsset');
        Route::get('kdBarang', 'kodeBarang');
        Route::get('kdBarang/{kd}', 'kodeBarang');
        // Route::get('formulir/daftar-po', 'daftarPO');
    });
});


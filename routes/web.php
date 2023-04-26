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
    return view('pages.beranda', [
        'title' => 'Beranda'
    ]);
})->middleware('authAdmin');

Route::controller(CustomersController::class)->group(function () {
    Route::get('/login', 'show');
    Route::post('login/attempt-login', 'attemptLogin');
    Route::get('/logout', 'userLogout');
});

Route::middleware(['authAdmin'])->group(function () {
    Route::controller(PagesController::class)->group(function () {

        Route::get('/dashboard', 'pageDashboard');
        Route::get('/data-barang', 'pageBarang');
        Route::get('/data-barang/{noinventaris}', 'detailBarang');
        Route::get('/barang-masuk', 'barangMasuk');
        Route::get('/data-exim', 'dataExim');
        Route::get('/data-baru', 'dataBaru');
        Route::get('/pengaturan', 'pengaturan');

    });
    
    Route::controller(ProsesController::class)->group(function(){
        
        Route::post('data-barang/{noinventaris}/dist', 'postDistribusi');
        Route::post('data-baru/upload', 'postUpload');
        Route::get('data-baru/import', 'importAsset');
        Route::get('kdBarang', 'kodeBarang');
        Route::get('kdBarang/{kd}', 'kodeBarang');
    });
});



Route::get('/home', function () {
    return view('pages.beranda', [
        'title' => 'Beranda'
    ]);
    // wes a awkmu sek penasaran ? tak ndak ok
})->middleware('authAdmin');

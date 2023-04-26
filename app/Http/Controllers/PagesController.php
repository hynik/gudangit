<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Distribusi;
use App\Models\KodeBarang;
use App\Models\StatusBarang;

class PagesController extends Controller
{

    private $objCustomer;
    public function __construct()
    {
        $this->objCustomer = new Customer();

    }

    public function pageDashboard(){

        return view('pages.beranda', [
            'title' => 'Dashboard'
        ]);
    }

    public function dataExim(){
        
        return view('pages.exim');
    }

    public function pageBarang(){

        return view('pages.barang', [
            'title' => 'Data Barang',
            'dataBarang' => StatusBarang::with(['barang'])->get()
        ]);
    }

    public function detailBarang($inventaris){
        $inventaris_id = str_replace('-', '/', $inventaris);
        return view('pages.details_data.item_barang', [
            'title' => 'Barang Iventaris '. $inventaris_id,
            'inventaris' => $inventaris_id,
            'dataSpesifik' => StatusBarang::with(['barang', 'userDis', 'distribusi', 'katBarang', 'barang.jenisBarang'])
            ->where('id_inventaris', '=', $inventaris_id)
            ->first(),
            'listDistribusi' => Distribusi::get()
        ]);
    }

    public function barangMasuk(){
        return view('pages.barangmasuk', [
            'title' => 'Rekam Barang Masuk'
        ]);
    }

    public function dataBaru(){
        return view('pages.databaru', [
            'title' => 'Buat Nomor Iventarisasi Baru',
            'kdBarang' => KodeBarang::get()
        ]);
    }

    public function pengaturan(){
        return view('pages.pengaturan');
    }
}

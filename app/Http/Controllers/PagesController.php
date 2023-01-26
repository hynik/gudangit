<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Distribusi;
use App\Models\StatusBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    private $objCustomer;
    public function __construct()
    {
        $this->objCustomer = new Customer();

    }

    private function idParam($index, $request){
        
        return str_replace('-', '/', $request->segments()[$index]);
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
            'dataBarang' => $this->objCustomer->dataBarang()
        ]);
    }

    public function detailBarang($inventaris){
        $inventaris_id = str_replace('-', '/', $inventaris);
        return view('pages.details_data.item_barang', [
            'title' => 'Barang Iventaris '. $inventaris_id,
            'inventaris' => $inventaris_id,
            'dataSpesifik' => StatusBarang::with(['barang', 'userDis', 'distribusi', 'katBarang'])
            ->where('id_inventaris', '=', $inventaris_id)
            ->first(),
        ]);
    }

    public function barangMasuk(){
        return view('pages.barangmasuk', [
            'title' => 'Rekam Barang Masuk'
        ]);
    }
    public function distribusiBarang($inventaris){

        $inventaris_id = str_replace('-', '/', $inventaris);
        return view('pages.distribusi', [
            'title' => 'Distribusi Barang',
            'dataSpesifik' => Barang::with([])->first()
        ]);
    }

    public function pengaturan(){
        return view('pages.pengaturan');
    }
}

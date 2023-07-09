<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Distribusi;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\StatusBarang;
use Milon\Barcode\Facades\DNS1DFacade;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'kdBarang' => JenisBarang::get()
        ]);
    }

    public function pengaturan(){
        return view('pages.pengaturan', [
            'title' => 'Pengaturan'
        ]);
    }

    public function cetak_pdf(Request $request){

        $barcode = [];
        $id_inventaris =[];

        if ($request->ajax()){
            foreach($request->input('data') as $data){
                $barcode[] = "<img src='data:image/png;base64,".DNS1DFacade::getBarcodePNG($data, 'C39', 1, 55)."' alt='barcode' />";
                $id_inventaris[] = $data;
            }
        }

        $pdf = Pdf::loadView('pages.cetak_pdf', [
            'title' => 'Cetak PDF',
            'data' => $request->input('data')
        ]);

        return $pdf->download('cetak inventaris aset baru');
    }

    public function barcode($inventaris){
        
        if(empty($inventaris)){
            echo "ID tidak ditemukan.";
        }

        echo "<img src='data:image/png;base64,".DNS1DFacade::getBarcodePNG(str_replace('-', '/', $inventaris), 'C39', 1, 55)."' alt='barcode' />";

    }

}

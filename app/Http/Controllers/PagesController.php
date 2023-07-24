<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Distribusi;
use App\Models\RincianAset;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use App\Models\MasterBarang;
use Milon\Barcode\Facades\DNS1DFacade;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
// use PDF;

class PagesController extends Controller
{

    private $countKat, $countPercentage_1, $countPercentage_2, $countPercentage_3, $countPercentage_4, $countPercentage_5;
    public function __construct()
    {

        $this->countKat = MasterBarang::toBase()
            ->selectRaw('count(IF(id_status = 1, 1, null)) as "on_stock"')
            ->selectRaw('count(IF(id_status = 2, 1, null)) as "out_stock"')
            ->selectRaw('count(IF(id_status = 3, 1, null)) as "distribusi"')
            ->selectRaw('count(IF(id_status = 4, 1, null)) as "rusak"')
            ->get();

        $this->countPercentage_1 = DB::select('select id_status, (count(IF(id_status = 1, 1, null)) * 100 / (select count(*) from master_barang)) as persen from master_barang group by id_status');
        $this->countPercentage_2 = DB::select('select id_status, (count(IF(id_status = 2, 1, null)) * 100 / (select count(*) from master_barang)) as persen from master_barang group by id_status');
        $this->countPercentage_3 = DB::select('select id_status, (count(IF(id_status = 3, 1, null)) * 100 / (select count(*) from master_barang)) as persen from master_barang group by id_status');
        $this->countPercentage_4 = DB::select('select id_status, (count(IF(id_status = 4, 1, null)) * 100 / (select count(*) from master_barang)) as persen from master_barang group by id_status');
    }

    public function pageDashboard()
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'countKat' => $this->countKat[0],
            'persentase_on_stock' => ($this->countPercentage_1 != null) ? $this->countPercentage_1[0]->persen : 0,
            'persentase_out_stock' => ($this->countPercentage_2 != null) ? $this->countPercentage_2[1]->persen : 0,
            'persentase_distribusi' => ($this->countPercentage_3 != null) ? $this->countPercentage_3[1]->persen : 0,
            'persentase_rusak' => ($this->countPercentage_4 != null) ? $this->countPercentage_4[1]->persen : 0,
        ]);
    }

    public function pageBarang()
    {

        return view('pages.barang', [
            'title' => 'Data Barang',
            'dataBarang' => MasterBarang::get()
        ]);
    }

    public function detailBarang($inventaris)
    {
        $inventaris_id = str_replace('-', '/', $inventaris);
        return view('pages.details_data.item_barang', [
            'title' => 'Barang Iventaris ' . $inventaris_id,
            'inventaris' => $inventaris_id,
            'dataSpesifik' => MasterBarang::with(['user', 'status_barang', 'kat_Barang'])
                ->where('id_inventaris', '=', $inventaris_id)
                ->first(),
        ]);
    }

    public function barangMasuk()
    {
        return view('pages.barangmasuk', [
            'title' => 'Rekam Barang Masuk',
            'countKat' => $this->countKat[0],
            'persentase_on_stock' => ($this->countPercentage_2 != null) ? $this->countPercentage_2[1]->persen : 0,
            'persentase_distribusi' => ($this->countPercentage_3 != null) ? $this->countPercentage_3[1]->persen : 0,
        ]);
    }

    public function dataBaru()
    {
        return view('pages.databaru', [
            'title' => 'Buat Nomor Iventarisasi Baru',
            'kdBarang' => KategoriBarang::get()
        ]);
    }

    public function pengaturan()
    {

        return view('pages.pengaturan', [
            'title' => 'Pengaturan',
        ]);
    }
    public function tambahPengguna()
    {
        $user_aktif = session()->get('userCredential')[0]['iduser'];

        return view('pages.pengaturan', [
            'title' => 'Tambah Pengguna',
            'data_pengguna' => Users::with(['level_user', 'data_user'])->where('userid', $user_aktif)->first(),
        ]);
    }
    public function ubahPassword()
    {
        $user_aktif = session()->get('userCredential')[0]['iduser'];
        return view('pages.pengaturan', [
            'title' => 'Ubah Password',
            'data_pengguna' => Users::with(['level_user', 'data_user'])->where('userid', $user_aktif)->first(),
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $template_cetakpdf = '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <title></title>
            <link rel="stylesheet" href="' . asset('adminlte/dist/css/adminlte.min.css') . '">
            <link rel="stylesheet" href="' . asset('adminlte/dist/css/custom.css') . '">
        </head>
        
        <body>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="text-center">CETAK NOMOR IVENTARIS</h3>
                        <p class="text-center">PT Sahabat Sakinah Senter</p>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    
                            ';
        $barcode = [];
        $id_inventaris = [];
        $elemTR = '';
            foreach ($request->input('data') as $data) {
                $barcode[] = "<img src='data:image/png;base64," . DNS1DFacade::getBarcodePNG($data, 'C39', 1, 55) . "' alt='barcode' />";
                $id_inventaris[] = $data;
                $template_cetakpdf .= '
                <div class="col-auto"><table class="table table-sm table-bordered">
                <tr>
                <td colspan="2"><img src="'.asset('logotok.png').'" alt="logo SSS" class="ml-1 mr-1">
                    <bold>INVENTARIS</bold>
                </td>
                <td rowspan="2" class="text-center"><img class="m-3" src="data:image/png;base64,' . DNS1DFacade::getBarcodePNG($data, 'C39', 1, 50) . '" alt="barcode" /></td>
                </tr>
                <tr>
                    <td>NO</td>
                    <td>' . $data . '</td>
                </tr></table>   </div>';
            }

        $template_cetakpdf .= '
            
            </div>
            </div>
        </body>
        
        </html>';

        echo $template_cetakpdf;


    }

    public function barcode($inventaris)
    {

        if (empty($inventaris)) {
            echo "ID tidak ditemukan.";
        }

        echo "<img src='data:image/png;base64," . DNS1DFacade::getBarcodePNG(str_replace('-', '/', $inventaris), 'C39', 1, 55) . "' alt='barcode' />";
    }

    public function tambahKat()
    {
        return view('pages.tambahKat', [
            'title' => 'Form'
        ]);
    }

    public function formulir()
    {
        $user_aktif = session()->get('userCredential')[0]['iduser'];
        $departement = Users::with(['departement'])->where('userid', $user_aktif)->first();

        return view('pages.formulir', [
            'title' => 'Formulir Pengajuan',
            'departement' => $departement,
            'data' => RincianAset::where('status_ap', 'proses persetujuan')
            ->orWhere('ajukan', 1)
            ->orWhere('ap_pimpinan', 1)
            ->orWhere('ap_ga', 1)
            ->orWhere('ap_dir', 1)
            ->first()
        ]);
    }
    public function pettycash()
    {
        return view('pages.formulir', ['title' => 'Formulir Pengajuan']);
    }
    public function laporanPembelian()
    {
        return view('pages.formulir', ['title' => 'Formulir Pengajuan']);
    }
    public function kelolaAset()
    {
        return view('pages.kelola_aset', ['title' => 'Kelola Aset']);
    }

    public function daftarPengguna()
    {
        return view('pages.daftar_pengguna', [
            'title' => 'DAFTAR PENGGUNA',
        ]);
    }

    public function daftarPO()
    {
        $user_aktif = session()->get('userCredential')[0]['id_departement'];
        $daftar_po = null;

        if ($user_aktif == 2){
            $daftar_po = RincianAset::where('status_ap', 'pembelian')->get();
        }elseif ($user_aktif == 1){
            $daftar_po = RincianAset::where('status_ap', 'disimpan')
            ->orWhere('status_ap', 'ditunda')
            ->get();
        }

        return view('pages.daftar_po', [
            'title' => 'Daftar Purchase Order (PO)',
            'daftar_po' => $daftar_po,
            'disabled' => RincianAset::whereIn('status_ap', ['proses persetujuan', 'pembelian', 'selesai'])->first()
        ]);
    }

    public function aprovPurchaseOrder()
    {
        $user_aktif = session()->get('userCredential')[0]['id_departement'];
        $daftar_po = null;

        if ($user_aktif == 3){
            $daftar_po = RincianAset::where([
                ['status_ap', '=', 'proses persetujuan'],
                ['ap_pimpinan', '=', 0]
            ])
            ->get();
        }elseif ($user_aktif == 4){
            $daftar_po = RincianAset::where([
                ['status_ap', 'proses persetujuan'],
                ['ap_ga', '=', 0]
            ])
            ->orWhere([
                ['status_ap', 'proses persetujuan'],
                ['ap_pimpinan', '=', 1],
                ['ap_ga', '=', 1],
                ['ap_dir', '=', 1],
            ])
            ->get();
        }elseif ($user_aktif == 5){
            $daftar_po = RincianAset::where([
                ['status_ap', 'proses persetujuan'],
                ['ap_dir', '=', 0]
            ])
            ->get();
        }

        return view('pages.daftar_po', [
            'title' => 'Daftar Purchase Order (PO)',
            'daftar_po' => $daftar_po,
            'disabled' => RincianAset::whereIn('status_ap', ['proses persetujuan', 'pembelian', 'selesai'])->first()
        ]);
    }

    public function editPengguna($userid)
    {

        $data_user = Users::with(['level_user', 'data_user', 'akses_fitur'])->where('userid', $userid)->first();

        return view('pages.pengguna', [
            'title' => 'Ubah Pengguna | ' . $userid,
            'data_user' => $data_user,
            'fitur' => json_decode($data_user->akses_fitur->fitur)
        ]);
    }

    public function hapusPengguna($userid){
        
        Users::where('userid', $userid)->delete();

        return back()->with(session()->push('warning', 'User telah dihapus.'));
    }

    public function priviewPrint(Request $request){

        $id_inventaris = [];
        $barcode = [];
        foreach ($request->input() as $data) {
            $barcode[] = DNS1DFacade::getBarcodePNG($data, 'C39', 1, 50);
            $id_inventaris[] = $data;
        }

        return view('pages.priview_print', [
            'title' => 'Priview Print Barcode',
            'id_inventaris' => $id_inventaris,
            'barcode' => $barcode
        ]);
    }

}

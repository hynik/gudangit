<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Distribusi;
use Illuminate\Support\Facades\DB;
use App\Models\StatusBarang;
use Illuminate\Http\Request;
use App\Imports\AssetImport;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;

class ProsesController extends Controller
{
    private $katBarang;

    public function postDistribusi(Request $request)
    {

        $dataParam = array($request->post('id_inventaris'), $request->post('idTim'), $request->post('customRadio'));

        if ($dataParam[2] == "masuk") {
            $this->katBarang = ['id_kat' => 3, 'ket' => 'stock lama'];
        } elseif ($dataParam[2] == "dist") {
            $this->katBarang = ['id_kat' => 4, 'ket' => 'distribusi'];
        } else {
            $this->katBarang = ['id_kat' => 1, 'ket' => 'stock rusak'];
        }

        $respons = StatusBarang::where('id_inventaris', $dataParam[0])
            ->update([
                'id_distribusi' => ($dataParam[1] != null) ? $dataParam[1] : null,
                'id_kat' => $this->katBarang['id_kat'],
                'userid' => session()->get('userCredential')[0]['iduser'],
                'keterangan' => $this->katBarang['ket'],
            ]);

        if ($respons > 0) {
            return redirect()->back()->with(['message' => session()->flash('success', 'Telah di Perbaharui')]);
        }
    }

    public function postUpload(Request $request){

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $imageName = md5(uniqid(rand(), true) . $image) . '.' . $image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('xlsx'), $imageName);

            if ($upload_success) {
                return response()->json(true, 200);
            }
            // Else, return error 400
            else {
                return response()->json('error', 400);
            }
        }
    }

    public function kodeBarang($kd=False){
        
        // $query = $kd;
        $kdBarang = DB::table('kode_barang')->where('kode', 'like', '%'.request('q').'%')->get();
        return response()->json($kdBarang, 200);
    }

    public function importAsset(){

        Excel::import(new AssetImport, public_path('/xlsx/test.xlsx'));
             
        // return back()->with('success', 'Data Berhasil di Import.');

        if (Session()->has('warning')){
            return back()->with('warning', Session()->get('warning'));
        }elseif(Session()->has('success')){
            return back()->with('success', Session()->get('success'));
        }

    }

    public function postGen(Request $request){
        
        //query untuk mengambil semua kode asset
        $getKode = DB::table('jenis_barang')->get('kode');
        $tambahData = "";
        foreach($getKode as $kode){

            //variable kode dengan huruf kecil
            $str_kode = strtolower($kode->kode);

            if (array_key_exists($str_kode, $request->post())){
                
                //query untuk mengambil data id inventaris, nama, dan kode jenis aset
                $queryCekLastID = DB::table('barang')->join('jenis_barang', 'barang.id_jenis', '=', 'jenis_barang.id_jenis')->where('jenis_barang.kode', '=', strtoupper($str_kode))->orderBy('barang.id_inventaris', 'DESC')->first();
                
                //query untuk mengambil id jenis aset
                $idJenisAset = DB::table('jenis_barang')->where('kode', '=', strtoupper($str_kode))->first('id_jenis');

                //mengambil id inventaris terakhir
                $numLastID = intval(explode('/', $queryCekLastID->id_inventaris ?? $kode->kode."/0000/".date('Y'))[1]);

                //perulangan untuk memasukkan ke database serta menambah nomor urut inventaris aset
                for ($i=1; $i <= intval($request->post($str_kode)); $i++){

                    DB::table('barang')->insert([
                        'id_inventaris' => $kode->kode."/".sprintf("%04s", $numLastID+$i)."/".date('Y'),
                        'id_jenis' => $idJenisAset->id_jenis,
                        'nama_merk' => $request->post("nm_".$str_kode),
                        'pengadaan' => date('Y-m-d')
                    ]);

                    DB::table('status_barang')->insert([
                        'id_kat' => 2,
                        'id_inventaris' => $kode->kode."/".sprintf("%04s", $numLastID+$i)."/".date('Y'),
                        'id_distribusi' => null,
                        'userid' => session()->get('userCredential')[0]['iduser'],
                        'keterangan' => 'stock baru',
                        'updated_at' => date('Y-m-d')
                    ]);
                }

                $tambahData .= $kode->kode." Sebanyak ".$request->post($str_kode)."\r\n";
            }
        }

        echo $tambahData."\r\n Telah Di Tambahkan Sebagai Aset Baru.";

    }

    public function dataMasterAset(Request $request){

        if($request->ajax()){

            if ($request->input('start_date') && $request->input('end_date')){
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if($end_date->greaterThan($start_date)){
                    
                    $data_aset = StatusBarang::with(['barang'])->whereBetween('updated_at', [$start_date, $end_date])->get();
                }else{
                    $data_aset = StatusBarang::with(['barang'])->latest()->get();
                }
            }
            elseif($request->input('pencarian')){
                
                if($request->input('pencarian') != null){
                    $q =$request->input('pencarian');
                    $data_aset = StatusBarang::with(['barang'])->where('id_inventaris', 'like', "%{$q}%")->get();
                    
                } else{
                    
                    $data_aset = StatusBarang::with(['barang'])->latest()->get();
                }
            }
            else{
                
                $data_aset = StatusBarang::with(['barang'])->get();
            }

            return response()->json([
                'aset' => $data_aset
            ]);
        }else{
            abort(403);
        }

    }

}

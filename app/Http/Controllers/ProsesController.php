<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Distribusi;
use Illuminate\Support\Facades\DB;
use App\Models\StatusBarang;
use Illuminate\Http\Request;
use App\Imports\AssetImport;
use Maatwebsite\Excel\Facades\Excel;

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

    }
}

<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\StatusBarang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Illuminate\Support\Facades\Validator;

class AssetImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        //  Validator::make($rows->toArray(), [
        //      '*.no' => 'required',
        //      '*.id_inventaris' => 'required',
        //      '*.id_jenis' => 'required',
        //      '*.nama_merk' => 'required',
        //  ])->validate();
  
        foreach ($rows as $row) {

            // dd($row['id_inventaris']);

            $cekid = Asset::select('id_inventaris')->where('id_inventaris', '=', $row['id_inventaris'])->get();
            
            if (count($cekid) > 0){
                $id = "";
                foreach($cekid as $existid){
                    $id .= $existid."\n";
                }
                return back()->with('warning', 'ID Inventaris sudah ada di database! '.$id);
            }else{
                
                Asset::create([
                    'id_inventaris' => $row['id_inventaris'],
                    'id_jenis' => $row['id_jenis'],
                    'nama_merk' => $row['nama_merk'],
                    'pengadaan' => date('Y-m-d')
                ]);
                StatusBarang::create([
                    'id_kat' => 2,
                    'id_inventaris' => $row['id_inventaris'],
                    'id_distribusi' => null,
                    'userid' => session()->get('userCredential')[0]['iduser'],
                    'keterangan' => 'stock baru',
                    'updated_at' => date('Y-m-d')
                ]);

            }
            
        }
        return back()->with('success', 'Data Berhasil di Import.');
    }

    public function rules(): array
    {
        return[
            'no' => 'required',
            'id_inventaris' => 'required',
            'id_jenis' => 'required',
            'nama_merk' => 'required',
        ];
    }
}

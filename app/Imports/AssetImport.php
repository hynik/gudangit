<?php

namespace App\Imports;

use App\Models\Asset;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssetImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Asset([
        //     'id_inventaris'=> $row[1],
        //     'id_jenis' => $row[2],
        //     'nama_merk' => $row[3],
        //     'pengadaan' => date('Y-m-d')
        // ]);

        // $data = Asset::get('id_inventaris');

        // foreach($data->toArray() as $d){
        //     // print_r($d['id_inventaris']);
        //     if (in_array('HS/0001/2019', $d)){
        //         echo "suda ada!";
        //     }
        // }
    }

    public function rules(): array
    {
        return [
            'id_inventaris' => Rule::in(['HS/0001/2019']),
        ];
    }
}

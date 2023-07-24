<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RincianAset extends Model{

    protected $table = 'rincian_aset';
    protected $fillable = [
        'nama_aset',
        'deskripsi',
        'units',
        'permintaan',
        'ajukan',
        'ap_pimpinan',
        'ap_ga',
        'ap_dir',
        'status_ap',
    ];
}

?>
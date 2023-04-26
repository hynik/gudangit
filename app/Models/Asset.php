<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model{

    protected $table = 'barang';
    protected $fillable = ['id_inventaris','id_jenis','nama_merk', 'pengadaan'];
}

?>
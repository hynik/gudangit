<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model{

    protected $table = 'master_barang';
    protected $fillable = ['id_inventaris', 'id_kat', 'id_dist_coll', 'id_dist_man', 'id_status', 'userid', 'nama_merk', 'tipe', 'pengadaan', 'keterangan_dist', 'pengelola_aset'];

    public function kat_Barang(){
        return $this->hasMany(KategoriBarang::class, 'id_kat', 'id_kat');
    }

    public function status_barang(){
        return $this->hasOne(StatusBarang::class, 'id_status', 'id_status');
    }

    public function user(){
        return $this->hasMany(Users::class, 'userid', 'userid');
    }

}

?>
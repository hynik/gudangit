<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBarang extends Model{

    protected $table = 'status_kondisi_barang';
    protected $fillable = ['id_kat', 'id_inventaris', 'id_distribusi', 'userid', 'id_status_kondisi', 'keterangan', 'update_at'];
    
    public function barang(){
        return $this->belongsTo(MasterBarang::class);
    }

    public function userDis(){
        return $this->hasMany(Users::class, 'userid', 'userid');
    }

    public function distribusi(){
        return $this->hasMany(Distribusi::class, 'id_distribusi', 'id_distribusi');
    }

    public function katBarang(){
        return $this->hasMany(KategoriBarang::class, 'id_kat', 'id_kat');
    }

}

?>
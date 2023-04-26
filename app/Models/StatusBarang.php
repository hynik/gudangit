<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBarang extends Model{

    protected $table = 'status_barang';
    
    public function barang(){
        return $this->hasMany(Barang::class, 'id_inventaris', 'id_inventaris');
    }

    public function userDis(){
        return $this->hasMany(Users::class, 'userid', 'userid');
    }

    public function distribusi(){
        return $this->hasMany(Distribusi::class, 'id_distribusi', 'id_distribusi');
    }

    public function katBarang(){
        return $this->hasMany(KatBarang::class, 'id_kat', 'id_kat');
    }

}

?>
<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model{

    protected $table = 'barang';
    
    public function statusBarang(){
        return $this->belongsTo(StatusBarang::class);
    }

    public function jenisBarang(){
        return $this->hasMany(JenisBarang::class, 'id_jenis', 'id_jenis');
    }

    public function timDistribusi(){
        return $this->hasMany(Distribusi::class, 'id_distribusi', 'id_distribusi');
    }
}

?>
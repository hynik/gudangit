<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model{

    protected $table = 'kategori_barang';
    
    public function barang(){
        return $this->belongsTo(MasterBarang::class);
    }

    public function statusBarang(){
        return $this->belongsTo(MasterBarang::class);
    }

}

?>
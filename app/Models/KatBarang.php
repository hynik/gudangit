<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KatBarang extends Model{

    protected $table = 'kategori_barang';
    
    public function statusBarang(){
        return $this->belongsTo(StatusBarang::class);
    }

}

?>
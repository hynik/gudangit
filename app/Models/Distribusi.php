<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model{

    protected $table = 'distribusi';
    
    public function statusBarang(){
        return $this->belongsTo(StatusBarang::class);
    }

    public function barangDistribusi(){
        return $this->belongsTo(Barang::class);
    }
}

?>
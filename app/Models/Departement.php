<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model{

    protected $table = 'departement';
    
    public function user(){
        return $this->belongsTo(Users::class);
    }

}

?>
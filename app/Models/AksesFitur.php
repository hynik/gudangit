<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksesFitur extends Model{

    protected $table = 'hak_akses_fitur';

    protected $fillable = ['fitur'];
    
    public function user(){
        return $this->belongsTo(Users::class);
    }

}

?>
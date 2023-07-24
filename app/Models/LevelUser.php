<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelUser extends Model{

    protected $table = 'level_user';
    
    public function user(){
        return $this->belongsTo(Users::class);
    }

}

?>
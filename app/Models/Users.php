<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{

    protected $table = 'users';
    protected $fillable = [
        'id_level',
        'id_fitur',
        'id_data_user',
        'id_departement',
        'username',
        'password',
        'name',
        'nama_belakang'
    ];
    
    public function statusBarang(){
        return $this->belongsTo(StatusBarang::class);
    }

    public function level_user(){
        return $this->hasMany(LevelUser::class, 'id_level', 'id_level');
    }

    public function data_user(){
        return $this->hasOne(DataUser::class, 'id_data_user', 'id_data_user');
    }

    public function akses_fitur(){
        return $this->hasOne(AksesFitur::class, 'id_fitur', 'id_fitur');
    }

    public function departement(){
        return $this->hasOne(Departement::class, 'id_departement', 'id_departement');
    }

    public function master_aset(){
        return $this->belongsTo(MasterBarang::class);
    }
}

?>
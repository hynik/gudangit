<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUser extends Model{

    protected $table = 'data_user';
    protected $fillable = [
        'alamat',
        'kode_pos',
        'kota',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public function user(){
        return $this->belongsTo(Users::class);
    }

}

?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    public $table = "users";

    public static function getUserID($userID)
    {
        $users = DB::table('users')
            ->select('username', 'password', 'name', 'userid')
            ->where('username', $userID)->first();

        if ($users){
            return $users;
        }
    }

}
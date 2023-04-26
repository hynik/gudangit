<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    public $table = "akun";

    public function getUserID($userID)
    {
        $users = DB::table('users')
            ->select('username', 'password', 'name', 'userid')
            ->where('username', $userID)->first();

        if ($users){
            return $users;
        }
    }

    public function dataBarang()
    {
        return DB::table('status_barang')
        ->join('barang', 'status_barang.id_inventaris', '=', 'barang.id_inventaris')
        ->join('jenis_barang', 'barang.id_jenis', '=', 'jenis_barang.id_jenis')
        ->get([
            'status_barang.id_inventaris',
            'jenis_barang.nama',
            'status_barang.keterangan'
        ]);
    }

    public function cariBarang($kodeBarang){
        $namaBarang = DB::table('barang')
        ->select('jenis_barang.nama')
        ->join('jenis_barang', 'barang.id_jenis', '=', 'jenis_barang.id_jenis')
        ->where('barang.id_inventaris', '=', 'HS/0001/2019')
        ->get()[0];

        return $namaBarang;
    }

    public function alltagihanSiswa(){

        $dataTagihanSiswa = DB::table('tagihan', 't')
        ->join('transaksi', 't.id_transaksi', '=', 'transaksi.id_transaksi', 'left')
        ->select('t.nm_tagihan', 't.nominal', 'transaksi.payment_type', 'transaksi.status_tr', 't.id_tagihan', 't.id_transaksi', 't.nis')
        ->paginate(10);

        return $dataTagihanSiswa;
    }

    public function getTagihanSiswa($nis){
        $queryTagihanSiswa = DB::table('tagihan', 't')
        ->join('transaksi', 't.id_transaksi', '=', 'transaksi.id_transaksi', 'inner')
        ->select('t.id_tagihan', 't.nm_tagihan', 't.nominal', 'transaksi.payment_type', 'transaksi.status_tr')
        ->where('t.nis', '=', $nis)
        ->get();

        return $queryTagihanSiswa;
    }

    public function getNisSiswa($userID){
        $queryNis = DB::table('akun')
        ->select('nis')->where('email', '=', $userID)->get();

        if ($queryNis){
            return $queryNis;
        }
    }
}
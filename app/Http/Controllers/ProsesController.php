<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\AksesFitur;
use App\Models\LevelUser;
use App\Models\RincianAset;
use Illuminate\Support\Facades\DB;
use App\Models\MasterBarang;
use App\Models\Departement;
use App\Models\DataUser;
use Illuminate\Http\Request;
use App\Imports\AssetImport;
use App\Models\KategoriBarang;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Session\Session;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;
use Psy\Readline\Hoa\Console;

class ProsesController extends Controller
{
    private $katBarang;

    public function postDistribusi(Request $request)
    {

        $dataParam = array($request->post('id_inventaris'), $request->post('tim'), $request->post('customRadio'));

        if ($dataParam[2] == "on_stock") {
            $this->katBarang = ['id_kat' => 1, 'ket' => 'on Stock'];
        } elseif ($dataParam[2] == "out_stock") {
            $this->katBarang = ['id_kat' => 2, 'ket' => 'Out Stock'];
        } elseif ($dataParam[2] == "distribusi") {
            $this->katBarang = ['id_kat' => 3, 'ket' => 'Distribusi'];
        } elseif ($dataParam[2] == "rusak") {
            $this->katBarang = ['id_kat' => 4, 'ket' => 'Rusak'];
        }
        if ($dataParam[1] == "management") {
            MasterBarang::where('id_inventaris', str_replace('-', '/', $dataParam[0]))->update([
                'keterangan_dist' => "Distribusi Management",
                'id_status' => $this->katBarang['id_kat'],
            ]);
        } elseif ($dataParam[1] == "collection") {
            MasterBarang::where('id_inventaris', str_replace('-', '/', $dataParam[0]))->update([
                'keterangan_dist' => "Distribusi Collection",
                'id_status' => $this->katBarang['id_kat'],
            ]);
        }elseif ($dataParam[1] == "gudang_it"){
            MasterBarang::where('id_inventaris', str_replace('-', '/', $dataParam[0]))->update([
                'keterangan_dist' => "Masuk Gudang IT",
                'id_status' => $this->katBarang['id_kat'],
            ]);
            
        }
        return redirect()->back()->with(session()->push('success', 'Telah di Perbaharui'));
    }

    public function postUpload(Request $request)
    {

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $imageName = md5(uniqid(rand(), true) . $image) . '.' . $image->getClientOriginalExtension();
            $upload_success = $image->move(public_path('xlsx'), $imageName);

            if ($upload_success) {
                return response()->json(true, 200);
            }
            // Else, return error 400
            else {
                return response()->json('error', 400);
            }
        }
    }

    public function kodeBarang($kd = False)
    {

        // $query = $kd;
        $kdBarang = DB::table('kode_barang')->where('kode', 'like', '%' . request('q') . '%')->get();
        return response()->json($kdBarang, 200);
    }

    public function importAsset()
    {

        Excel::import(new AssetImport, public_path('/xlsx/test.xlsx'));

        // return back()->with('success', 'Data Berhasil di Import.');

        if (Session()->has('warning')) {
            return back()->with('warning', Session()->get('warning'));
        } elseif (Session()->has('success')) {
            return back()->with('success', Session()->get('success'));
        }
    }

    public function simpanDatabase(Request $request)
    {

        $id_inventaris = [];

        if ($request->ajax()) {

            foreach ($request->keys() as $key) {

                if ($key != "_token") {
                    //query untuk mengambil data id inventaris, nama, dan kode jenis aset
                    $queryCekLastID = DB::table('master_barang')->join('kategori_barang', 'master_barang.id_kat', '=', 'kategori_barang.id_kat')->where('kategori_barang.kode', '=', strtoupper($key))->orderBy('master_barang.id_inventaris', 'DESC')->first();

                    //mengambil id inventaris terakhir
                    $numLastID = intval(explode('/', $queryCekLastID->id_inventaris ?? strtoupper($key) . "/0000/" . date('Y'))[1]);
                    $sum = 1;
                    for ($i = 0; $i < intval($request->input($key)['jml']); $i++) {

                        $id_inventaris[$i] = strtoupper($key) . "/" . sprintf("%04s", $numLastID + $sum++) . "/" . date('Y');

                        MasterBarang::insert([
                            'id_inventaris' => strtoupper($key) . "/" . sprintf("%04s", $numLastID + $sum++) . "/" . date('Y'),
                            'id_kat' => KategoriBarang::where('kode', $key)->first()->id_kat,
                            'id_dist_coll' => null,
                            'id_dist_man' => null,
                            'id_status' => 1,
                            'userid' => session()->get('userCredential')[0]['iduser'],
                            'nama_merk' => $request->input($key)['merk'],
                            'tipe' => $request->input($key)['tipe'],
                            'pengadaan' => date('Y-m-d'),
                            'keterangan_dist' => 'Stock Aset Baru',
                            'pengelola_aset' => 'GA',
                        ]);
                    }
                }
            }
            // dd($id_inventaris);
            // return redirect()->route([PagesController::class, 'priviewPrint']);
            echo json_encode([
                'msg' => "Telah Di Tambahkan Sebagai Aset Baru.",
                'data' => http_build_query($id_inventaris)
            ]);

            // return view('pages.priview_print', [
            //     'title' => 'Cetak nomor Inventaris'
            // ]);
        }
    }

    public function dataMasterAset(Request $request)
    {

        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {

                    $data_aset = MasterBarang::with(['kat_Barang', 'status_barang', 'user'])->whereBetween('updated_at', [$start_date, $end_date])->get();
                } else {
                    $data_aset = MasterBarang::with(['kat_Barang', 'status_barang', 'user'])->latest()->get();
                }
            } elseif ($request->input('pencarian')) {

                if ($request->input('pencarian') != null) {
                    $q = $request->input('pencarian');
                    $data_aset = MasterBarang::with(['kat_Barang', 'status_barang', 'user'])->where('id_inventaris', 'like', "%{$q}%")->get();
                } else {

                    $data_aset = MasterBarang::with(['kat_Barang', 'status_barang', 'user'])->latest()->get();
                }
            } else {

                $data_aset = MasterBarang::with(['kat_Barang', 'status_barang', 'user'])->get();
            }

            return response()->json([
                'aset' => $data_aset
            ]);
        } else {
            abort(403);
        }
    }

    public function ambilKat(Request $request)
    {


        if ($request->ajax()) {

            if (!empty($request->input('id_kat')) && $request->input('id_kat') != null) {

                $kat_barang = KategoriBarang::where('id_kat', $request->input('id_kat'))->first();
                return json_encode(['kategori' => $kat_barang]);
            } else {

                $kat_barang = KategoriBarang::get();
                return json_encode(['kategori' => $kat_barang]);
            }
        }
    }

    public function tambahKategori(Request $request)
    {

        $validasi = $request->validate([
            'nama_kategori' => 'required',
            'kode_kategori' => 'required',
        ]);

        if (!empty($request->input())) {

            $cek_jika_ada = KategoriBarang::where('nama', $validasi['nama_kategori'])->first();

            if ($cek_jika_ada != null) {

                if ($cek_jika_ada->kode == $request->input('kode_kategori')) {

                    return back()->with(session()->push('error', 'Sudah ada!'));
                }
            }

            $id_akhir = KategoriBarang::orderBy('id_kat', 'desc')->first();
            KategoriBarang::insert([
                'id_kat' => (!empty($request->input('id_kategori'))) ? $request->input('id_kategori') : $id_akhir->id_kat + 1,
                'nama' => $validasi['nama_kategori'],
                'kode' => $validasi['kode_kategori']
            ]);
            return back()->with(session()->push('success', 'Jenis Aset Baru Telah Di Tambahkan ' . $request->input('nama_kategori') . ' Dengan Kode ' . $request->input('kode_kategori')));
        } else {

            return back()->with(session()->push('warning', 'Terdapat kolom yang belum terisi. atau nama kategori tidak dengan huruf kecil semua.'));
        }
    }

    public function hapusKategori(Request $request)
    {

        if ($request->ajax()) {
            KategoriBarang::where('id_kat', $request->input('id_kat'))->delete();

            return json_encode(['respon', "Kategori dengan ID " . $request->input('id_kat') . " Telah Di Hapus."]);
        }
    }

    public function editKategori(Request $request, $id_kategori)
    {

        // $validasi = $request->validate([
        //     'nama_jenis' => 'required',
        //     'kode_jenis' => 'required'
        // ]);

        if (!empty($request->ajax())) {

            KategoriBarang::where('id_jenis', $id_kategori)->update([
                'kode' => $request->input('kode_jenis')
            ]);

            dd($request->input('kode_jenis'));
        }
    }

    public function tambahPengguna(Request $request)
    {
        // $validation = $request->validate([
        //     'password_baru' => 'min:6 | max: 20 | confirmed',
        //     'ulangi_password_baru' => ''
        // ]);

        if ($request->input('password_baru') == $request->input('ulangi_password_baru')) {

            $AksesFitur = new AksesFitur();
            $AksesFitur->fitur = json_encode(
                [
                    'fitur' => $request->input('fitur'),
                    'approval' => ($request->input('level_user') == 2) ? true : false
                ]
            );
            $AksesFitur->save();

            $DataUser = new DataUser();
            $DataUser->fill([
                'alamat' => $request->input('alamat'),
                'kode_pos' => $request->input('kode_pos'),
                'kota' => $request->input('kota'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tgl_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
            ]);
            $DataUser->save();

            Users::insert([
                'userid' => Users::orderBy('userid', 'desc')->first()->userid + 1,
                'id_level' => $request->input('level_user'),
                'id_fitur' => $AksesFitur->id,
                'id_data_user' => $DataUser->id,
                'id_departement' => $request->input('departement'),
                'username' => $request->input('nama_depan') . '_' . Departement::where('id_departement', $request->input('departement'))->first()->nama_alias,
                'password' => Hash::make($request->input('password_baru')),
                'name' => $request->input('nama_depan'),
                'nama_belakang' => $request->input('nama_belakang')
            ]);

            return back()->with(session()->push('success', 'Pengguna Baru Telah Di Buat.'));
        }
    }

    public function daftarPengguna(Request $request)
    {

        if ($request->ajax()) {
            return json_encode(['data_pengguna' => Users::with(['level_user'])->get()]);
        }
    }

    public function editPengguna(Request $request)
    {

        $userid = $request->input('userid');
        $dataUser = Users::where('userid', $userid)->first();

        if (!empty($userid)) {
            //Update akses fitur

            AksesFitur::where('id_fitur', $dataUser->id_fitur)->update([
                'fitur' => json_encode(['fitur' => ($request->input('fitur') == null) ? [] : $request->input('fitur'), 'approval' => ($request->input('level_user') == 2) ? true : false])
            ]);

            //update data user
            $DataUser = ([
                'alamat' => $request->input('alamat'),
                'kota' => $request->input('domisili')
            ]);
            DataUser::where('id_data_user', $dataUser->id_data_user)->update($DataUser);

            //update user
            Users::where('userid', $userid)->update([
                'id_level' => $request->input('level_user'),
                'password' => (!empty($request->input('password_baru'))) ? Hash::make($request->input('password_baru')) : $request->input('password_lama'),
                'name' => $request->input('nama_depan'),
                'nama_belakang' => $request->input('nama_belakang'),
            ]);

            return back()->with(session()->push('success', 'Pengguna Baru Telah Di Buat.'));
        }
    }

    public function ubahPassword(Request $request)
    {

        if (!empty($request->input('iduser'))) {

            Users::where('userid', $request->input('iduser'))->update([
                'password' => Hash::make($request->input('password_baru')),
            ]);

            return back()->with(session()->push('success', 'Pengguna Baru Telah Di Buat.'));
        }
    }

    public function simpanFormulir(Request $request)
    {

        if ($request->ajax()) {

            $RincianAset = new RincianAset();
            $RincianAset->fill([
                'nama_aset' => json_encode($request->input('items')),
                'deskripsi' => json_encode($request->input('desc')),
                'units' => json_encode($request->input('unit')),
                'permintaan' => $request->input('permintaan'),
                'ajukan' => false,
                'ap_pimpinan' => false,
                'ap_ga' => false,
                'ap_dir' => false,
                'status_ap' => 'disimpan',
            ]);
            $RincianAset->save();

            echo json_encode([
                'id_permintaan' => $RincianAset->id,
                'msg' => 'Pengajuan telah disimpan.'
            ]);
        }
    }

    public function ajukanFormulir(Request $request)
    {

        if ($request->ajax()) {

            RincianAset::where('id_permintaan', $request->input('id_permintaan'))->update([
                'ajukan' => 1,
                'status_ap' => 'proses persetujuan'
            ]);

            return redirect()->back()->with(session()->push('success', "Formulir diajukan."));
        }else{
            
            RincianAset::where('id_permintaan', $request->input('id_permintaan'))->update([
                'ajukan' => 1,
                'status_ap' => 'proses persetujuan'
            ]);

            return redirect()->back()->with(session()->push('success', "Formulir diajukan."));
        }
    }
    
    public function aprovPurchaseOrder(Request $request){

        if ($request->input('id_permintaan') != null){
            
            if ($request->input('aprov') == "pembelian"){
                RincianAset::where('id_permintaan', $request->input('id_permintaan'))->update([
                    'status_ap' => 'pembelian'
                ]);
            }
            elseif ($request->input('aprov') == "selesai"){
                RincianAset::where('id_permintaan', $request->input('id_permintaan'))->update([
                    'status_ap' => 'selesai'
                ]);
            }
            else{
                RincianAset::where('id_permintaan', $request->input('id_permintaan'))->update([
                    ($request->input('aprov') == 3) ? 'ap_pimpinan' : (($request->input('aprov') == 4) ? 'ap_ga' : 'ap_dir') => 1,
                    'status_ap' => 'proses persetujuan'
                ]);
            }
        
            return redirect()->back()->with(session()->push('success', "Formulir telah disetujui."));
        }
    }

    public function hapusFormulir($id){

        RincianAset::where('id_permintaan', $id)->delete();

        return back()->with(session()->push('warning', 'Formulir Purchase Order telah dihapus!'));
    }

    public function terimaFormulir($id){

        RincianAset::where('id_permintaan', $id)->update([
            'status_ap' => 'diterima'
        ]);

        return back()->with(session()->push('success', 'Aset telah diterima oleh tim IT.'));
    }
}

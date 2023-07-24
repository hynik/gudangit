@extends('home')
@section('pengaturan')
<div class="row justify-content-center">
    <div class="col-10">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user shadow">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$data_pengguna->name}} {{$data_pengguna->nama_belakang}}</h3>
                <h5 class="widget-user-desc">{{$data_pengguna->level_user[0]->level}}</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-rounded" src="https://sim.unusa.ac.id/siakad/siakad/uploads/fotomhs/2019/3130019012.jpg?r=35569" alt="User Avatar">
            </div>
            <div class="card-body">
                <div class="row mb-md-5 mb-sm-3"></div>
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Username</h5>
                            <!-- <span class="description-text">abdi@adm</span> -->
                            <span class="">{{$data_pengguna->username}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Jenis Kelamin</h5>
                            <span class="">{{$data_pengguna->data_user->jenis_kelamin}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">Tempat Tanggal Lahir</h5>
                            <span class="">{{$data_pengguna->data_user->tempat_lahir}}, {{$data_pengguna->data_user->tanggal_lahir}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
</div>

@if (Request::segment(2) == 'tambah-pengguna')
<form action="{{url('pengaturan/tambah-pengguna')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span>Tambah Pengguna atau Akun Baru</span>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_depan">Nama Depan</label>
                            <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Nama Depan">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col {{ $errors->has('password_baru') ? ' has-error' : '' }}">
                            <label for="password_baru">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></div>
                                </div>
                                @if ($errors->has('password_baru'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first() }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col {{ $errors->has('ulangi_password_baru') ? ' has-error' : '' }}">
                            <label for="ulangi_password_baru">Ulangi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="ulangi_password_baru" id="ulangi_password_baru" placeholder="Ulangi Password Baru">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></div>
                                </div>
                                @if ($errors->has('ulangi_password_baru'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ulangi_password_baru') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="departement">Jenis Kelamin</label>
                            <select class="form-control" id="departement" name="departement">
                                <option value="1">Staff IT</option>
                                <option value="2">Staff GA</option>
                                <option value="3">IT Manager</option>
                                <option value="4">GA Manager</option>
                                <option value="5">Direktur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="surabaya">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="2023-07-01">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                            <option value="laki-laki" selected>Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap" value="lidah wetan">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kota_tinggal">Domisili</label>
                            <input type="text" class="form-control" name="kota" id="kota_tinggal" placeholder="Kota Tinggal" value="surabaya">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="60213" value="60213">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span>Hak Akses Akun</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <span>Fitur Menu Formulir</span>
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" id="po" name="fitur[]" value="purchase_order">
                                <label for="po" class="custom-control-label">Purchase Order</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="daftarpo" name="fitur[]" value="daftar_purchase_order">
                                <label for="daftarpo" class="custom-control-label">Daftar Purchase Order</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="laporanpo" name="fitur[]" value="laporan_purchase_order">
                                <label for="laporanpo" class="custom-control-label">Laporan Purchase Order</label>
                            </div>
                        </div>
                        <div class="col">
                            <span>Fitur Menu Pengaturan</span>
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" id="tambahpengguna" name="fitur[]" value="tambah_pengguna">
                                <label for="tambahpengguna" class="custom-control-label">Tambah Pengguna</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="daftarpengguna" name="fitur[]" value="daftar_pengguna">
                                <label for="daftarpengguna" class="custom-control-label">Daftar Pengguna</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <span>Fitur Menu Master Aset</span>
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" id="dataaset" name="fitur[]" value="data_aset">
                                <label for="dataaset" class="custom-control-label">Data Aset</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="tambahkategori" name="fitur[]" value="tambah_kategori">
                                <label for="tambahkategori" class="custom-control-label">Tambah Kategori</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="tambahaset" name="fitur[]" value="tambah_aset">
                                <label for="tambahaset" class="custom-control-label">Tambah Aset</label>
                            </div>
                        </div>
                        <div class="col">
                            <span>Menu Fitur Kelola Aset</span>
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" id="kelolaaset" name="fitur[]" value="kelola_aset">
                                <label for="kelolaaset" class="custom-control-label">Kelola Aset</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="level_user">
                                <option value="3">Standar</option>
                                <option value="2">Admin</option>
                                <option value="1">Super Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Tambah User Baru</button>
        </div>
    </div>
</form>
@elseif (Request::segment(2) == 'ubah-password')
<form action="{{url('pengaturan/ubah-password')}}" method="post" id="form_ubah_password">
    @csrf
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <div class="row">
                        <h5><b class="text-muted">Ubah Password</b></h5>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password_baru">Kata Sandi Baru</label>
                                <input type="password" name="password_baru" class="form-control" id="password_baru" placeholder="Kata sandi baru">
                            </div>
                            <div class="form-group">
                                <label for="ulangi_password_baru">Konfirmasi Kata Sandi</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password_baru" placeholder="Konfirmasi kata sandi">
                                <div class="invalid-feedback">
                                    Kata Sandi tidak cocok.
                                </div>
                            </div>
                            <input type="hidden" name="iduser" value="{{$data_pengguna->userid}}">
                            <button type="submit" class="btn btn-warning btn-sm">Ubah Kata Sandi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endif
@endsection
@section('custom-script')

<script>
    $('#confirm_password_baru').keyup(function() {
        if ($('#password_baru').val() != $('#confirm_password_baru').val()) {
            $('#confirm_password_baru').addClass('is-invalid')
        }else{
            $('#form_ubah_password').addClass('was-validated')
            $('#confirm_password_baru').removeClass('is-invalid')
        }
    });
</script>

@endsection
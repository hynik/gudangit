@extends('home')
@section('pengaturan')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="pic" class="rounded-circle p-1 bg-primary" width="110">
                    <div class="mt-3">
                        <h4>{{$data_user->name}}</h4>
                        <p class="text-secondary mb-1">{{$data_user->level_user[0]->level}}</p>
                        <p class="text-muted font-size-sm">{{$data_user->data_user->tempat_lahir}}, {{$data_user->data_user->tanggal_lahir}}</p>
                        <span class="text-secondary text-wrap">{{$data_user->data_user->alamat}}</span>
                        <!-- <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary">Message</button> -->
                    </div>
                </div>
                <hr class="my-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <span class="text-secondary">{{$data_user->data_user->kota}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fa-solid fa-person-half-dress"></i>
                        <span class="text-secondary">{{$data_user->data_user->jenis_kelamin}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fa-solid fa-signs-post"></i>
                        <span class="text-secondary">{{$data_user->data_user->kode_pos}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <i class="fa-solid fa-fingerprint"></i>
                        <span class="text-secondary">{{$data_user->username}}</span>
                    </li>
                    <!-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>Facebook</h6>
                        <span class="text-secondary">bootdey</span>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <form action="{{url('pengaturan/pengguna')}}/edit" method="post">
            @csrf
            <input type="hidden" value="{{Request::segment(3)}}" name="userid">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-profil-tab" data-toggle="pill" href="#custom-tabs-four-profil" role="tab" aria-controls="custom-tabs-four-profil" aria-selected="true">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-password-tab" data-toggle="pill" href="#custom-tabs-four-password" role="tab" aria-controls="custom-tabs-four-password" aria-selected="false">Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-fitur-tab" data-toggle="pill" href="#custom-tabs-four-fitur" role="tab" aria-controls="custom-tabs-four-fitur" aria-selected="false">Fitur</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                    </li> -->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-profil" role="tabpanel" aria-labelledby="custom-tabs-four-profil-tab">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Depan</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="nama_depan" class="form-control" value="{{$data_user->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Belakang</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="nama_belakang" class="form-control" value="{{$data_user->nama_belakang}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Domisili</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="domisili" class="form-control" value="{{$data_user->data_user->kota}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea type="text" name="alamat" class="form-control">{{$data_user->data_user->alamat}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-password" role="tabpanel" aria-labelledby="custom-tabs-four-password-tab">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password Baru</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="password_baru" class="form-control">
                                    <input type="hidden" name="password_lama" class="form-control" value="{{$data_user->password}}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-fitur" role="tabpanel" aria-labelledby="custom-tabs-four-fitur-tab">
                            <div class="row mb-3">
                                <div class="col">
                                    <span>Fitur Menu Formulir</span>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input class="custom-control-input" type="checkbox" id="po" name="fitur[]" value="purchase_order" <?= (in_array("purchase_order", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="po" class="custom-control-label">Purchase Order</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="daftarpo" name="fitur[]" value="daftar_purchase_order" <?= (in_array("daftar_purchase_order", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="daftarpo" class="custom-control-label">Daftar Purchase Order</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="laporanpo" name="fitur[]" value="laporan_purchase_order" <?= (in_array("laporan_purchase_order", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="laporanpo" class="custom-control-label">Laporan Purchase Order</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <span>Fitur Menu Pengaturan</span>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input class="custom-control-input" type="checkbox" id="tambahpengguna" name="fitur[]" value="tambah_pengguna" <?= (in_array("tambah_pengguna", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="tambahpengguna" class="custom-control-label">Tambah Pengguna</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="daftarpengguna" name="fitur[]" value="daftar_pengguna" <?= (in_array("daftar_pengguna", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="daftarpengguna" class="custom-control-label">Daftar Pengguna</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span>Fitur Menu Master Aset</span>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input class="custom-control-input" type="checkbox" id="dataaset" name="fitur[]" value="data_aset" <?= (in_array("data_aset", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="dataaset" class="custom-control-label">Data Aset</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="tambahkategori" name="fitur[]" value="tambah_kategori" <?= (in_array("tambah_kategori", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="tambahkategori" class="custom-control-label">Tambah Kategori</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="tambahaset" name="fitur[]" value="tambah_aset" <?= (in_array("tambah_aset", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="tambahaset" class="custom-control-label">Tambah Aset</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <span>Menu Fitur Kelola Aset</span>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input class="custom-control-input" type="checkbox" id="kelolaaset" name="fitur[]" value="kelola_aset" <?= (in_array("kelola_aset", $fitur->fitur)) ? 'checked' : '' ?>>
                                        <label for="kelolaaset" class="custom-control-label">Kelola Aset</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="level_user">
                                        <option value="3" <?= ($data_user->level_user[0]->id_level == 3) ? 'selected' : '' ?>>Standar</option>
                                        <option value="2" <?= ($data_user->level_user[0]->id_level == 2) ? 'selected' : '' ?>>Admin</option>
                                        <option value="1" <?= ($data_user->level_user[0]->id_level == 1) ? 'selected' : '' ?>>Super Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div> -->
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpang Perubahan</button>
                </div>
            </div>
        </form>
        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                        <p>Web Design</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Website Markup</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>One Page</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Mobile Template</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Backend API</p>
                        <div class="progress" style="height: 5px">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>

@endsection
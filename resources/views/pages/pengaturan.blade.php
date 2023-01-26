@extends('home')
@section('pengaturan')
<div class="row justify-content-center">
    <div class="col-10">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user shadow">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">Abdi Arkananta</h3>
                <h5 class="widget-user-desc">Admin</h5>
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
                            <span class="">abdi@adm</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Jenis Kelamin</h5>
                            <span class="">Laki - Laki</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">Tempat Tanggal Lahir</h5>
                            <span class="">Surabaya, 19-09-2001</span>
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
                            <label for="exampleInputEmail1">Kata Sandi Baru</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Kata sandi baru">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Kata Sandi</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Konfirmasi kata sandi">
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm">Simpan dan Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
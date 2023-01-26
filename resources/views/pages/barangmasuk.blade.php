@extends('home')
@section('barang-masuk')

<div class="row">
    <div class="col">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fa-solid fa-boxes-stacked"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Barang Stock</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Barang Baru Masuk</span>
                <span class="info-box-number">41,410</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-3">
        <button class="btn btn-outline-primary">Tambah Barang</button>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Rekam Barang</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>ID Inventaris</th>
                                <th>Nama Barang</th>
                                <th>Kondisi</th>
                                <th>Pengadaan</th>
                                <th>Staff IT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>HS/0001/2019</td>
                                <td>Headset</td>
                                <td>Baru</td>
                                <td>08/07/2019</td>
                                <td>Abdi</td>
                            </tr>
                            <tr>
                                <td>HS/0002/2019</td>
                                <td>Headset</td>
                                <td>Baru</td>
                                <td>08/07/2019</td>
                                <td>Abdi</td>
                            </tr>
                            <tr>
                                <td>HS/0003/2019</td>
                                <td>Headset</td>
                                <td>Baru</td>
                                <td>08/07/2019</td>
                                <td>Abdi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection
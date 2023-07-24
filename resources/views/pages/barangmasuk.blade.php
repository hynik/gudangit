@extends('home')
@section('barang-masuk')

<div class="row">
    <div class="col">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fa-solid fa-boxes-stacked"></i></span>

            <div class="info-box-content">
                <span class="info-box-text text-bold">Aset Dalam Gudang</span>
                <span class="info-box-number">{{$countKat->on_stock}}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_on_stock ?>%"></div>
                </div>
                <span class="progress-description">
                    {{$persentase_on_stock}}% Dari Keseluruhan Aset
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right"></i></span>

            <div class="info-box-content">
                <span class="info-box-text text-bold">Aset Telah di Distribusi</span>
                <span class="info-box-number">{{$countKat->distribusi}}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_distribusi ?>%"></div>
                </div>
                <span class="progress-description">
                    {{$persentase_distribusi}}% Dari Keseluruhan Aset
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-3">
        <a href="{{url('master/barang-masuk/data-baru')}}" class="btn btn-outline-primary">Tambah Barang</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Track Record Aset Distribusi</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap" id="tbTrackRecord">
                        <thead>
                            <tr>
                                <th>ID Inventaris</th>
                                <th>Nama Barang</th>
                                <th>Kondisi</th>
                                <th>Pengadaan</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td></td>
                                <td>Headset</td>
                                <td>Baru</td>
                                <td>08/07/2019</td>
                                <td>Abdi</td>
                            </tr> -->
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
@section('custom-script')
<script>
    function fetch(start_date, end_date, pencarian) {
        $.ajax({
            url: "{{url('data-master')}}",
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {

                totalData = data.aset.length;

                if (data.aset.length <= 0) {
                    toastr.warning("Pencarian " + pencarian + " tidak ditemukan");
                }

                var i = 1;
                var idx = 0;
                $('#tbTrackRecord').DataTable({
                    data: data.aset,
                    searching: false,
                    response: true,
                    // columnDefs: [{
                    //     targets: [0],
                    //     orderable: false,
                    // }],
                    columns: [
                        {
                            data: "id_inventaris",
                            render: (data, type, row, meta) => {
                                return '<a href="{{url("data-barang")}}/' + row.id_inventaris.replaceAll('/', '-') + '" class="text-decoration-none">' + row.id_inventaris + '</a>';
                            }
                        },
                        {
                            data: "nama aset",
                            render: (data, type, row, meta) => {
                                return row.kat__barang[0].nama;
                            }
                        },
                        {
                            render: (data, type, row, meta) => {
                                return row.status_barang.kondisi
                            }
                        },
                        {
                            render: (data, type, row, meta) => {
                                return row.pengadaan;
                            }
                        },
                        {
                            render: (data, type, row, meta) => {
                                return row.user[0].name;
                            }
                        },
                    ]
                });
            }
        });

    }

    fetch();
</script>
@endsection
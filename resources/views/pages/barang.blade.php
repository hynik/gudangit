@extends('home')
@section('data-barang')

<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Master Barang</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="height: 500px;">
                    <table class="table table-head-fixed text-nowrap" id="tbMasterBarang">
                        <thead>
                            <tr>
                                <th>Nomor Inventaris</th>
                                <th>Ubah</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataBarang as $data)
                            <tr>
                                <td><a href="{{url('data-barang')}}/<?= str_replace('/', '-', $data->id_inventaris) ?>" class="text-decoration-none">{{$data->id_inventaris}}</a></td>
                                <td><a href="{{url('data-barang/dist')}}/<?= str_replace('/', '-', $data->id_inventaris) ?>" class="text-decoration-none">Distribusikan</a></td>
                                <td>{{$data->nama}}</td>
                                <td><span class="badge badge-<?= ($data->keterangan == 'stock baru') ? 'success' : 'primary' ?>">{{$data->keterangan}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrapper">
                    { filter }
                    { length }
                    { info }
                    { paging }
                    { table }
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
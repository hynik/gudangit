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
                                <th>#</th>
                                <th>Nomor Inventaris</th>
                                <th>Waktu Pengadaan</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataBarang as $data)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox{{$data->id_inventaris}}" value="">
                                        <label class="custom-control-label" for="customCheckbox{{$data->id_inventaris}}"></label>
                                    </div>
                                </td>
                                <td><a for="customCheckbox1" href="{{url('data-barang')}}/<?= str_replace('/', '-', $data->id_inventaris) ?>" class="text-decoration-none">{{$data->id_inventaris}}</a></td>
                                <td>{{$data->barang[0]->pengadaan}}</td>
                                <td>{{$data->barang[0]->nama_merk}}</td>
                                @if ($data->keterangan == "stock baru")
                                <td><span class="badge badge-success">{{$data->keterangan}}</span></td>
                                @elseif ($data->keterangan == "stock lama")
                                <td><span class="badge badge-warning">{{$data->keterangan}}</span></td>
                                @elseif ($data->keterangan == "stock rusak")
                                <td><span class="badge badge-danger">{{$data->keterangan}}</span></td>
                                @else
                                <td><span class="badge badge-info">{{$data->keterangan}}</span></td>
                                @endif
                            </tr>
                            @endforeach
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
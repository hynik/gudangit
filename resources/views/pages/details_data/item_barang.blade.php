@extends('home')
@section('item-barang')

<div class="row mb-3">
    <div class="col">
        <a href="{{url('/data-barang')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-auto">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-3 content-justify-center">
                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col pl-5">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="card-title"><b></b></h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="text-muted card-title">{{$dataSpesifik->id_inventaris}}</h3>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row mb-3">
                            <div class="col">
                                <span><b>Keterangan</b></span><br>
                                <span class="badge badge-info">Distribusi</span> <span class="badge badge-warning">Barang Keluar</span>
                            </div>
                            <div class="col">
                                <span><b>Distribusi Tim</b></span><br>
                                <span>{{$dataSpesifik->distribusi->nama_tim}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <span><b>Staff IT</b></span><br>
                                <span>{{$dataSpesifik->userDis[0]->name}}</span>
                            </div>
                            <div class="col">
                                <span><b>Kondisi Barang</b></span><br>
                                <span>{{$dataSpesifik->katBarang[0]->kondisi}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>Dari</b></span><br>
                                <span>{{$dataSpesifik->keterangan}}</span>
                            </div>
                            <div class="col">
                                <span><b>Waktu Distribusi</b></span><br>
                                <span>{{$dataSpesifik->terakhir_diubah}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('home')
@section('item-barang')

<div class="row mb-3">
    <div class="col">
        <a href="{{url('master/data-aset')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-auto">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-3 content-justify-center">
                        <!-- <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-fluid mx-auto d-block"> -->
                        <i class="fa-solid fa-{{$dataSpesifik->kat_Barang[0]->nama}} fa-10x"></i>
                    </div>
                    <div class="col pl-5">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="card-title"><b>{{strtoupper($dataSpesifik->kat_Barang[0]->nama)}}</b></h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="text-muted card-title">{{$dataSpesifik->id_inventaris}}</h3>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row mb-3">
                            <div class="col">
                                <span><b>Nama Merk</b></span><br>
                                <span>{{$dataSpesifik->nama_merk}}</span>
                                <!-- <span class="badge badge-info">Distribusi</span> <span class="badge badge-warning">Barang Keluar</span> -->
                            </div>
                            <div class="col">
                                <span><b>Distribusi</b></span><br>
                                <span>{{$dataSpesifik->keterangan_dist}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <span><b>Staff IT</b></span><br>
                                <span>{{$dataSpesifik->user[0]->name}}</span>
                            </div>
                            <div class="col">
                                <span><b>Kondisi Barang</b></span><br>
                                <span>{{$dataSpesifik->status_barang->kondisi}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span><b>Status</b></span><br>
                                <span>{{$dataSpesifik->status_barang->status}}</span>
                            </div>
                            <div class="col">
                                <span><b>Waktu Distribusi</b></span><br>
                                <span>{{$dataSpesifik->updated_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider mb-3"></div>
                <form action="{{ url()->current() }}/dist" method="post">
                    @csrf
                    <input type="hidden" name="id_inventaris" value="{{Request::segment(2)}}">
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-primary" type="radio" id="customRadioMasuk" name="customRadio" value="on_stock" <?= ($dataSpesifik->id_status == 1) ? 'checked' : '' ?>>
                                <label for="customRadioMasuk" class="custom-control-label">On Stock</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-danger" type="radio" id="customRadioKeluar" name="customRadio" value="out_stock" <?= ($dataSpesifik->id_status == 2) ? 'checked' : '' ?>>
                                <label for="customRadioKeluar" class="custom-control-label">Out Stock</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-primary" type="radio" id="customRadioDist" name="customRadio" value="distribusi" <?= ($dataSpesifik->id_status == 3) ? 'checked' : '' ?>>
                                <label for="customRadioDist" class="custom-control-label">Distribusi</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-danger" type="radio" id="customRadioRusak" name="customRadio" value="rusak" <?= ($dataSpesifik->id_status == 4) ? 'checked' : '' ?>>
                                <label for="customRadioRusak" class="custom-control-label">Rusak</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-control" aria-label="Default select example" name="tim">
                                <option value="management">Management</option>
                                <option value="collection">Collection</option>
                                <option value="gudang_it">Gudang IT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ml-2">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
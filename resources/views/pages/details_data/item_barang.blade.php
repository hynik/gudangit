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
                        <!-- <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-fluid mx-auto d-block"> -->
                        <i class="fa-solid fa-{{$dataSpesifik->barang[0]->jenisBarang[0]->nama}}  fa-10x"></i>
                    </div>
                    <div class="col pl-5">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="card-title"><b>{{$dataSpesifik->barang[0]->nama_merk}}</b></h3>
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
                                <span>{{(count($dataSpesifik->distribusi) > 0 ) ? $dataSpesifik->distribusi[0]->nama_tim : '-'}}</span>
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
                                <span><b>Status</b></span><br>
                                <span>{{$dataSpesifik->keterangan}}</span>
                            </div>
                            <div class="col">
                                <span><b>Waktu Distribusi</b></span><br>
                                <span>{{$dataSpesifik->updated_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider mt-3"></div>
                <div class="row">
                    <div class="col">
                        <h3 class="card-title text-muted">
                            Distribusi Barang
                        </h3>
                    </div>
                </div>
                <div class="dropdown-divider mb-3"></div>
                <form action="{{ url()->current() }}/dist" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-primary" type="radio" id="customRadioMasuk" name="customRadio" value="masuk" <?= ($dataSpesifik->id_kat == 2) ? 'disabled checked' : ($dataSpesifik->keterangan == 'stock rusak' ? 'disabled' : '') ?>>
                                <label for="customRadioMasuk" class="custom-control-label">Masuk</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-danger" type="radio" id="customRadioKeluar" name="customRadio" value="keluar" <?= ($dataSpesifik->id_kat == 1) ? 'disabled checked' : '' ?>>
                                <label for="customRadioKeluar" class="custom-control-label">Keluar</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-outline custom-control-input-warning" type="radio" id="customRadioDist" name="customRadio" value="dist" <?= ($dataSpesifik->id_kat == 4) ? 'disabled checked' : ($dataSpesifik->keterangan == 'stock rusak' ? 'disabled' : '') ?>>
                                <label for="customRadioDist" class="custom-control-label">Distribusi</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <!-- <label for="exampleSelectBorderWidth2"><span>Barang Keluar yang di Distribusikan</span></label> -->
                                <select class="custom-select form-control-border border-width-2" id="selectorDist" name="idTim">
                                    <option selected>{{(count($dataSpesifik->distribusi) > 0 ) ? $dataSpesifik->distribusi[0]->nama_tim : '-'}}</option>
                                    @foreach($listDistribusi as $daftarList)
                                    <option value="{{$daftarList->id_distribusi}}">{{$daftarList->nama_tim}}</option>
                                    @endforeach
                                </select>
                                <span><small class="text-muted">Silahkan untuk memilih divisi yang akan di distribusi</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ml-2">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                        <div class="col-auto">
                            <input type="hidden" name="id_inventaris" value="{{$dataSpesifik->id_inventaris}}">
                            <a href="{{url('/data-barang')}}" class="btn btn-sm btn-outline-warning">Tidak Jadi</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    if ($("#customRadioMasuk").is(":checked")) {
        $("#selectorDist").attr("disabled", true);
    }

    $("#customRadioMasuk").click(() => {
        $("#selectorDist").attr("disabled", true);
    });
    $("#customRadioKeluar").click(() => {
        $("#selectorDist").attr("disabled", true);
    });

    $("#customRadioDist").click(() => {
        $("#selectorDist").attr("disabled", false);
    });
</script>
@endsection
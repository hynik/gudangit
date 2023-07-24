@extends('home')
@section('formulir')
<div class="row">
    <div class="col">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Status Pengajuan</h3>
            </div>
            <div class="card-body p-0">
                <div class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">

                        <div class="step {{($data->ajukan == 1 && $data->status_ap == 'selesai') ? 'active' : ''}}" data-target="#logins-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="{{($data->ajukan == 1 && $data->status_ap == 'selesai') ? 'true' : ''}}" <?= ($data->ajukan == 1 && $data->status_ap == 'selesai') ? '' : 'disabled' ?>>
                                <span class="bs-stepper-circle"><i class="fa-brands fa-wpforms"></i></span>
                                <span class="bs-stepper-label">Pengajuan</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step {{($data->ap_pimpinan == 1 && $data->ap_ga == 1 && $data->ap_dir == 1 && $data->status_ap == 'proses persetujuan') ? 'active' : ''}}" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="{{($data->status_ap == 'proses persetujuan' && $data->ap_pimpinan == 1 && $data->ap_ga == 1 && $data->ap_dir == 1) ? 'true' : ''}}" <?= ($data->status_ap == 'proses persetujuan' && $data->ap_pimpinan == 1 && $data->ap_ga == 1 && $data->ap_dir == 1) ? '' : 'disabled' ?>>
                                <span class="bs-stepper-circle"><i class="fa-solid fa-file-signature"></i></span>
                                <span class="bs-stepper-label">Approval</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step {{($data->status_ap == 'pembelian' || $data->status_ap == 'selesai') ? 'active' : ''}}" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="{{($data->status_ap == 'pembelian' || $data->status_ap == 'selesai') ? 'true' : ''}}" <?= ($data->status_ap == 'pembelian' || $data->status_ap == 'selesai') ? '' : 'disabled' ?>>
                                <span class="bs-stepper-circle"><i class="fa-solid fa-cart-shopping"></i></span>
                                <span class="bs-stepper-label">Pembelian Aset</span>
                            </button>
                        </div>
                        <!-- <div class="line"></div>
                        <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle"><i class="fa-solid fa-box"></i></span>
                                <span class="bs-stepper-label">Inventarisasi Aset</span>
                            </button>
                        </div> -->
                        <div class="line"></div>
                        <div class="step {{($data->status_ap == 'selesai') ? 'active' : ''}}" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="{{($data->status_ap == 'selesai') ? 'true' : ''}}" <?= ($data->status_ap == 'selesai') ? '' : 'disabled' ?> >
                                <span class="bs-stepper-circle {{($data->status_ap == 'selesai') ? 'bg-green' : ''}}"><i class="fa-solid fa-check"></i></span>
                                <span class="bs-stepper-label">Selesai</span>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="bs-stepper-content">

                        <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Status Pengajuan</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="timeline">
                    <div class="{{($data->ajukan == 1 && $data->status_ap == 'selesai') ? '' : 'd-none'}}">
                        <i class="fas fa-solid fa-circle bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{date_format($data->updated_at, 'h:m:s')}}</span>
                            <h3 class="timeline-header"><a href="#">Pengajuan Formulir</a> permintaan dari IT</h3>
                            <div class="timeline-body">
                                Pengajuan Formulir Purchase Order permintaan dari IT sedang dalam proses pengajuan kepada pimpinan.
                            </div>
                        </div>
                    </div>
                    <div class="{{($data->status_ap == 'proses persetujuan' && $data->ap_pimpinan == 1 && $data->ap_ga == 1 && $data->ap_dir == 1) ? '' : 'd-none'}}">
                        <i class="fas fa-solid fa-circle bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{date_format($data->updated_at, 'h:m:s')}}</span>
                            <h3 class="timeline-header"><a href="#">Pengajuan Formulir</a> pengajuan kepada pimpinan</h3>
                            <div class="timeline-body">
                                Formulir sedang dalam pengecekan oleh pimpinan.
                            </div>
                        </div>
                    </div>
                    <div class="{{($data->status_ap == 'pembelian') ? '' : 'd-none'}}">
                        <i class="fas fa-solid fa-circle bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{date_format($data->updated_at, 'h:m:s')}}</span>
                            <h3 class="timeline-header"><a href="#">Pengajuan Formulir</a> pembelian aset</h3>
                            <div class="timeline-body">
                                Pembelian aset baru.
                            </div>
                        </div>
                    </div>
                    <div class="{{($data->status_ap == 'selesai') ? '' : 'd-none'}}">
                        <i class="fas fa-solid fa-check bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{date_format($data->updated_at, 'h:m:s')}}</span>
                            <div class="timeline-body">
                                Selesai
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@if (Request::segment(2) == 'pengajuan')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <!-- <div class="btn-group" id="btnSunting">
                    <button class="btn btn-primary active" aria-current="page"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-primary">Sunting</button>
                </div> -->
                <div class="btn-group" id="btnSimpan">
                    <button class="btn btn-primary active" aria-current="page"><i class="fa-solid fa-paper-plane"></i></button>
                    <!-- <input type="text" class="form-group-control bg-primary" disabled> -->
                    <button class="btn btn-primary">Simpan</button>
                </div>
                <div class="btn-group" id="btnAjukan">
                    <input type="hidden" name="id_permintaan">
                    <button class="btn btn-primary active" aria-current="page"><i class="fa-solid fa-paper-plane"></i></button>
                    <!-- <input type="text" class="form-group-control bg-primary" disabled> -->
                    <button class="btn btn-primary">Ajukan</button>
                </div>
                <div class="btn-group" id="btnTambah">
                    <button class="btn btn-success active" aria-current="page"><i class="fa-solid fa-square-plus"></i></button>
                    <!-- <input type="text" class="form-group-control bg-primary" disabled> -->
                    <button class="btn btn-success">Tambah Item</button>
                </div>
                <div class="btn-group" id="btnHapus">
                    <button class="btn btn-danger active" aria-current="page"><i class="fa-solid fa-square-minus"></i></button>
                    <!-- <input type="text" class="form-group-control bg-primary" disabled> -->
                    <button class="btn btn-danger">Hapus Item</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <!-- <h5 class="font-weight-bold text-center" style="text-decoration: underline;"></h5> -->
        <p class="text-center header-por"><b style="text-decoration: underline;">Purchase Order Request From</b></br> No. POR/IT-SSS/2023/V/002</p>
    </div>
</div>
<div class="row">
    <div class="col-1">Name</div>
    <div class="col-auto">:</div>
    <div class="col">
        <!-- Akhmad Sholahuddin Arif -->-
    </div>
</div>
<div class="row">
    <div class="col-1">Division</div>
    <div class="col-auto">:</div>
    <div class="col">
        IT
    </div>
</div>
<div class="row">
    <div class="col-1">Date</div>
    <div class="col-auto">:</div>
    <div class="col">
        30 Mei 2023
    </div>
</div>

<div class="row mt-5">
    <div class="col">
        <form action="" id="rincian_aset">
            @csrf
            <input type="hidden" name="permintaan" value="{{$departement->departement->nama_departement}}">
            <table class="table table-bordered table-po">
                <tr>
                    <td>No</td>
                    <td>Items</td>
                    <td>Unit</td>
                    <td>Description</td>
                </tr>
                <tr id="row-kosong">
                    <td colspan=4 class="text-center text-muted">Tidak Ada Data</td>
                    <!-- <td>1.</td>
                <td>
                    Headset
                    Merk: Logitech
                    Type: H110
                </td>
                <td>50</td>
                <td>
                    Spesifications:
                    - Headset: 20 Hz 20,0000 Hz
                </td> -->
                </tr>
            </table>
        </form>
    </div>
    <div class="col-auto" id="kolom_tombol">
        <div class="row mt-5 mb-3">


        </div>
    </div>
</div>
<div class="row d-flex justify-content-end">
    <div class="col-4">
        <table class="table table-bordered">
            <tr>
                <td class="text-center">Requested by</td>
            </tr>
            <tr>
                <td>
                    TDD
                </td>
            </tr>
            <tr>
                <td>
                    <p class="text-center"><span style="text-decoration: underline;">-</span><br>IT Manager</p>
                </td>
            </tr>
        </table>
    </div>
</div>

@elseif (Request::segment(2) == 'laporan-pembelian')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Formulir</th>
                            <th>Waktu Permintaan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>PO Juli 2023</td>
                            <td>09-07-2023</td>
                            <td>Selesai</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
@section('custom-script')
<script>
    $('.btn-tool').click(() => {
        $('.card-body').removeClass('collapse');
        $('.card-body').addClass('show');
    });


    var i = 1;
    $('#btnTambah').click(() => {

        if (i > $('.tr-items').length) {
            $('#row-kosong').addClass('d-none');
            $('.table-po').append('<tr id="row' + i + '" class="tr-items"><td>' + i + '.</td><td><textarea class="form-control" name="items[]" rows="3"></textarea></td><td class="col-2"><input type="text" name="unit[]" class="form-control"></td><td><textarea class="form-control" name="desc[]" rows="3"></textarea></td></tr>');
            i++;
            // i += 1;
            // $('#kolom_tombol').append('<div class="row mb-3"><i class="fa-solid fa-square-plus fa-2x" id="btnTambah'+i+'" style="color: #198754;"></i><i class="fa-solid fa-square-minus fa-2x" id="btnHapus'+i+'" style="color: #dc3545;"></i></div>');
        } else {
            $('.table-po').append('<tr id="row' + i + '" class="tr-items"><td>' + i + '.</td><td><textarea class="form-control" rows="3"></textarea></td><td>50</td><td><textarea class="form-control" rows="3"></textarea></td></tr>');

        }
    });

    $('#btnSimpan').click(function() {

        $.ajax({
            url: "{{url('formulir/simpan')}}",
            data: $('form').serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(res) {

                $('[name^="id_permintaan"]').attr("value", res.id_permintaan);
                toastr.success(res.msg);
            }
        });

    });

    $('#btnHapus').click(() => {
        // i=$('.tr-items').length;
        if (i <= 1) {
            $('#row-kosong').removeClass('d-none');
            $('#row' + i).remove();
        } else {
            $('#row' + i).remove()
            i--;
        }
    });

    $('#btnSunting').click(() => {
        console.log($('.header-por').val());
    });

    $('#btnAjukan').click(() => {
        data = "id_permintaan=" + $('[name^="id_permintaan"]').val() + "&_token={{csrf_token()}}";

        $.ajax({
            url: "{{url('formulir/ajukan')}}",
            data: data,
            type: 'POST',
            success: function(res) {
                toastr.success(res);
            }
        });
    });
</script>
@endsection
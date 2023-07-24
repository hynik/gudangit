@extends('home')
@section('databaru')

<div class="row mb-3">
    <div class="col"><a href="{{url('master/barang-masuk')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Aset Baru</h3>
            </div>
            <div class="card-body p-0">
                <div class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">

                        <div class="step active" data-target="#import-batch-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="import-batch-part" id="import-batch-part-part-trigger" aria-selected="true">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Unggah Data Aset Per Item / Bersamaan</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#manual-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="manual-part" id="manual-part-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Pilih Kategori</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Impor Data ke Database</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">

                        <div id="import-batch-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="import-batch-part-part-trigger">
                            <!-- <div class="row mb-4">
                                <div class="col d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row mb-3">
                                <!--begin::Input group-->
                                <div class="col">
                                    <!--begin::Dropzone-->
                                    <div class="" id="actions">
                                        <form method="post" enctype="multipart/form-data" class="dropzone">
                                            @csrf
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Max size file 16Mb</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </form>
                                    </div>
                                    <!--end::Dropzone-->
                                </div>

                                <!-- <form action="{{url('data-baru/gen')}}" method="post"> -->
                                <!-- </form> -->
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <span class="text-muted mb-2">Silahkan pilih aset yang ingin dibuat nomor iventaris sesuai urut.</span>
                                    <div class="form-inline">
                                        <div class="form-group mr-2">
                                            <select class="custom-select" id="kBarang">
                                                @foreach($kdBarang as $dKode):
                                                <option value="{{$dKode->kode}}">{{strtoupper($dKode->nama)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-success" id="tambah">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div id="genKol" class="mb-2"></div>
                                </div>
                            </div>

                            <button class="btn btn-primary" onclick="stepper.next()" id="next1">Next</button>
                        </div>
                        <div id="manual-part" class="content" role="tabpanel" aria-labelledby="manual-part-trigger">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-hover responsive" id="tb_pilih_kategori">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Jumlah</th>
                                                <th>Merk</th>
                                                <th>Tipe</th>
                                                <th>Kode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td><input type="checkbox" name="" id="checkbox" value="hd" checked></td>
                                                <td id="jml_hd">12</td>
                                                <td id="merk_hd">Logitech</td>
                                                <td id="tipe_hd">Logitech</td>
                                                <td id="hd">HD</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="" id="checkbox" value="kb" checked></td>
                                                <td id="jml_kb">12</td>
                                                <td id="merk_kb">Logitech</td>
                                                <td id="tipe_kb">Logitech</td>
                                                <td id="kb">KB</td>
                                            </tr> -->
                                        </tbody>
                                        <!-- <thead>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th>3</th>
                                            </tr>
                                        </thead> -->
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary" onclick="stepper.previous()" id="prev1">Previous</button>
                            <button class="btn btn-primary" onclick="stepper.next()" id="next2">Next</button>
                        </div>
                        <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="fileupload-process w-100">
                                        <div id="progress-bar-import" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>0%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row d-flex mb-3">
                                <span class="align-self-end text-muted">1 Data berhasil di import.</span>
                            </div> -->
                            <button class="btn btn-outline-primary" onclick="stepper.previous()" id="prev2">Previous</button>
                            <!-- <button class="btn btn-success" type="button" id="btn-formOne" disabled>Generate</button> -->
                            <button type="button" class="btn btn-primary" id="btn_import">Import ke Database</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    function createKolom(param, index) {
        let divRow = $(document.createElement('div')).attr('class', 'row mb-1').attr('id', 'formRow' + index);
        divRow.appendTo('#genKol');

        let divColCost = $(document.createElement('div')).attr('class', 'col').attr('id', 'formKol');
        divColCost.after().html('<input class="form-control" type="number" id="formKol" placeholder="Jumlah ' + param + '" name="jml_' + param.toLowerCase() + '">');
        divColCost.appendTo('#formRow' + index)

        let divColName = $(document.createElement('div')).attr('class', 'col').attr('id', 'formKol');
        divColName.after().html('<input class="form-control" type="text" id="formKol" placeholder="Brand / Merk" name="merk_' + param.toLowerCase() + '">');
        divColName.appendTo('#formRow' + index)

        let divColTipe = $(document.createElement('div')).attr('class', 'col').attr('id', 'formKol');
        divColTipe.after().html('<input class="form-control" type="text" id="formKol" placeholder="Tipe" name="tipe_' + param.toLowerCase() + '">');
        divColTipe.appendTo('#formRow' + index)

        $('<button class="btn btn-danger" id="btnHapus" data-id="' + index + '">Hapus</button>').appendTo('#formRow' + index);

        $('<input type="hidden" id="formKol" name="kode" value="' + param.toLowerCase() + '">').appendTo('#formRow' + index);
    }

    var idxKolom = 0;
    $('#tambah').click(function() {
        $('#btn-formOne').removeAttr("disabled");
        var kBarang = $('#kBarang').val()
        if ($('input[name*="' + kBarang.toLowerCase() + '"]').length <= 0) {
            idxKolom += 1;
            createKolom(kBarang, idxKolom.toString());
            // $('#tb_pilih_kategori tbody').append('<tr id="row' + idxKolom + '"></tr>');
        } else {
            toastr.warning("Kolom " + kBarang + " sudah ada!");
        }
    });

    $(document).on('click', '#btnHapus', function() {
        let id = $(this).data('id');
        // $('#formRow'+id).empty();
        $('#formRow' + id).remove();
        $('#row' + id).remove();
    });

    $('#next1').click(function() {

        var elem_tr = '';
        var count = 1;

        $('[name^="merk_"], [name^="jml_"], [name^="tipe_"], [name="kode"]').each(function(idx, elem) {
            if (count == 1) {
                elem_tr += '<tr><td><input type="checkbox" id="checkbox" value="' + $(elem).attr('name').split('_')[1] + '"></td>';
            }
            if (count == 4) {
                elem_tr += '<td id="' + $(elem).attr('name') + '">' + elem.value + '</td></tr>';
                count = 1;
            } else {
                elem_tr += '<td id="' + $(elem).attr('name') + '">' + elem.value + '</td>';
                count++;
            }
        });
        $('#tb_pilih_kategori tbody').append(elem_tr);

    });

    $('#prev1').click(function() {
        $('#tb_pilih_kategori tbody tr').remove();
    });


    //variable untuk menampung data yang akan di import ke dalam database
    var data_aset = {};

    $('#next2').click(function() {

        $('input[id="checkbox"]').each(function() {
            if (this.checked) {
                var kode = $(this).val();
                data_aset[kode] = {
                    jml: $('#jml_' + $(this).val()).text(),
                    merk: $('#merk_' + $(this).val()).text(),
                    tipe: $('#tipe_' + $(this).val()).text(),
                }

            }
        });
    });

    var stepper = new Stepper($('.bs-stepper')[0], {
        linear: true,
        animation: false,
        selectors: {
            steps: '.step',
            trigger: '.step-trigger',
            stepper: '.bs-stepper'
        }
    });

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false;

    var dropzone = new Dropzone('.dropzone', {
        url: "{{url('data-baru/upload')}}",
        thumbnailWidth: 200,
        maxFilesize: 16,
        acceptedFiles: ".xls,.xlsx,.csv,.xltx",
        // clickable: ".fileinput-button",
        uploadMultiple: false,
        // paramName: "file",
        addRemoveLinks: true,
    });

    // Update the total progress bar
    dropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    });
    // DropzoneJS Demo Code End

    $('#btn_import').click(function() {

        data_aset['_token'] = "{{csrf_token()}}";

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {

                    if (evt.lengthComputable) {
                        var pct = ((evt.loaded / evt.total) * 100);
                        $('.progress-bar').width(pct + '%');
                        $('.progress-bar').html(pct + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: "{{url('data-baru/simpan-database')}}",
            dataType: 'JSON',
            data: data_aset,
            // contentType: false,
            // cache: false,
            // processData:false,
            beforeSend: function(){
                $('.progress-bar').width('0%');
                $('.progress-bar').html('0%');
            },
            success: function(result) {
                
                // $('#genKol').empty();
                // $('#btn_import').attr('disabled', 'disabled');
                // indow.location.href = "{{url('master/barang-masuk/priview')}}";
                $('.progress-bar').width('0%');
                $('.progress-bar').html('0%');
                toastr.success(result.msg);
                window.location.href = "{{url('master/barang-masuk/priview')}}/?"+result.data;
            },
            error: function(result){
                toastr.error("Tidak ada data yang di import.");
            }
        });

    });
</script>
@endsection
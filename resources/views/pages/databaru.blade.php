@extends('home')
@section('databaru')

<div class="row mb-3">
    <div class="col"><a href="{{url()->previous()}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">bs-stepper</h3>
            </div>
            <div class="card-body p-0">
                <div class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">

                        <div class="step active" data-target="#import-batch-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="import-batch-part" id="import-batch-part-part-trigger" aria-selected="true">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Import Batch Asset</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#manual-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="manual-part" id="manual-part-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Pilih Kategori Barang</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Simpan</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">

                        <div id="import-batch-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="import-batch-part-part-trigger">
                            <div class="row mb-3">
                                <div class="col d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="fv-row">
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
                                <!--end::Input group-->
                            </div>
                            <button class="btn btn-primary mt-3" onclick="stepper.next()">Next</button>
                        </div>
                        <div id="manual-part" class="content" role="tabpanel" aria-labelledby="manual-part-trigger">
                            <div class="row mb-3">
                                <div class="col-md-6 col-6form-inline">
                                    <span class="text-muted mb-2">Silahkan pilih aset yang ingin dibuat nomor iventaris sesuai urut.</span>
                                    <div class="form-group mr-2">
                                        <select class="form-control" id="kBarang">
                                            @foreach($kdBarang as $dKode):
                                            <option value="{{$dKode->kode}}">{{$dKode->kode}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="tambah">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" id="genKol"></div>
                            <button class="btn btn-outline-primary" onclick="stepper.previous()">Previous</button>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <form action="{{url('data-baru/import')}}" method="get">
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="row">
                                    <div class="col-3 col-md-3 border-right mr-2">
                                        <h5>Data Iventaris Okt 2023</h5>
                                        <p>Ukuran file 128k</p>
                                    </div>
                                    <div class="col-7 col-md-7">
                                        <div class="row">
                                            <div class="fileupload-process w-100">
                                                <div id="progress-bar-import" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>0%</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex h-50">
                                            <span class="align-self-end text-muted">1 Data berhasil di import.</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary" onclick="stepper.previous()">Previous</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    function createKolom(param) {
        let divCol = $(document.createElement('div')).attr('class', 'col');
        divCol.after().html('<input class="form-control" type="number" placeholder="' + param + '" name="' + param.toLowerCase() + '">');
        divCol.appendTo('#genKol')
    }

    // var ExcelToJSON = function() {
    //     this.parseExcel = function(file) {
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             var data = e.target.result;
    //             var workbook = XLSX.read(data, {
    //                 type: 'binary'
    //             });
    //             workbook.SheetNames.forEach(function(sheetName) {
    //                 var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
    //                 var productList = JSON.parse(JSON.stringify(XL_row_object));
    //                 console.log(productList)
    //             })
    //         };
    //         reader.onerror = function(ex) {
    //             console.log(ex);
    //         };

    //         reader.readAsBinaryString(file);
    //     };
    // };

    // function handleFileSelect(evt) {
    //     var files = evt.target.files; // FileList object
    //     var xl2json = new ExcelToJSON();
    //     xl2json.parseExcel(files[0]);
    // }
    // Request File System Access
    // window.requestFileSystem(window.PERSISTENT, 0, (fs) => {
    //     // Request a handle to "SheetJS.xlsx", making a new file if necessary
    //     handleFileSelect(fs.root.getFile("xlsx/data.csv"))
    // });

    $('#tambah').click(function() {
        let kBarang = $('#kBarang').val()
        if ($('input[name*="' + kBarang.toLowerCase() + '"]').length <= 0) {
            createKolom(kBarang)
        } else {
            toastr.warning("Kolom " + kBarang + " sudah ada!")
        }
    })

    var stepper = new Stepper($('.bs-stepper')[0], {
        linear: true,
        animation: false,
        selectors: {
            steps: '.step',
            trigger: '.step-trigger',
            stepper: '.bs-stepper'
        }
    });

    stepper.next()
    stepper.next()

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
    })
    // DropzoneJS Demo Code End
</script>
@endsection
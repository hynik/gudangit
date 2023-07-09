@extends('home')
@section('data-barang')

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Aset TI PT Sahabat Sakinah Senter</p>
                <div class="row justify-content-center content-body-modal">
                    <div class="col-auto">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td colspan="2"><img src="https://sahabatsakinah.id/img/core-img/favicon.ico" alt="logo SSS" class="ml-1 mr-1">
                                    <bold>INVENTARIS</bold>
                                </td>
                                <td rowspan="2" class="text-center imgbarcode"><img id="modalBarcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG('MS/0001/2023', 'C39', 1, 55)}}" alt="barcode" /></td>
                            </tr>
                            <tr>
                                <td>NO</td>
                                <td class="noinventaris">MS/0001/2023</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <div class="input-group">
            <input type="text" class="form-control" id="cari" placeholder="Pencarian" />
            <div class="input-group-append">
                <button class="btn-cari btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col-auto">
        <div class="input-group">
            <input type="text" class="form-control" id="startDate" />
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa-solid fa-calendar"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="input-group">
            <input type="text" class="form-control" id="endDate" />
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa-solid fa-calendar"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" id="btnFilter">Filter</button>
        <button class="btn btn-danger" id="btnReset">Reset</button>
        <button class="btn btn-success " id="btn-selects" value="0"><i class="fa-solid fa-check-double"></i></button>
        <button class="btn btn-warning" id="btnPDF"><i class="fa-solid fa-file-pdf"></i></button>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-hover text-nowrap" id="tbMasterBarang">
            <thead>
                <tr>
                    <th>
                        <div class="custom-control custom-checkbox" id="selectAll">
                            <input class="custom-control-input custom-control-input-primary custom-control-input-outline" type="checkbox" id="ceklisAll">
                            <label for="ceklisAll" class="custom-control-label"></label>
                        </div>
                    </th>
                    <th>Nomor Inventaris</th>
                    <th>Waktu Pengadaan</th>
                    <th>Nama Barang</th>
                    <th>Keterangan</th>
                    <th>Lihat Barcode</th>
                </tr>
            </thead>
            <tbody>
                <!-- @foreach($dataBarang as $data)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox{{$data->id_inventaris}}" value="">
                            <label class="custom-control-label" for="customCheckbox{{$data->id_inventaris}}"></label>
                        </div>
                    </td>
                    <td><a href="{{url('data-barang')}}/<?= str_replace('/', '-', $data->id_inventaris) ?>" class="text-decoration-none">{{$data->id_inventaris}}</a></td>
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
                    <td class="text-center">
                        <button class="btn btn-outline-primary btnModal" data-toggle="modal" data-target="#barcode-{{str_replace('/', '', $data->id_inventaris)}}">
                            <i class="fa-solid fa-barcode"></i>
                        </button>
                    </td>
                </tr>
                @endforeach -->
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('custom-script')
<script>

    var totalData = 0;

    $(document).ready(function() {

        $('#startDate').daterangepicker({
            singleDatePicker: true,
            minYear: 2019,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $('#endDate').daterangepicker({
            singleDatePicker: true,
            minYear: 2019,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });


        $('#btnFilter').click(() => {
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            if (startDate == "" || endDate == "") {
                toastr.warning("Harus di isi dulu!");
            } else {
                $('#tbMasterBarang').DataTable().destroy();
                fetch(startDate, endDate, '');
                toastr.success("Filter dari " + startDate + " s/d " + endDate);
            }
        });

        $('#btnReset').click(() => {
            $('#tbMasterBarang').DataTable().destroy();
            fetch();
        });

        $('.btn-cari').click(function() {
            let pencarian = $('#cari').val();

            $('#tbMasterBarang').DataTable().destroy();
            fetch(null, null, pencarian);

        });

        $(document).on('click', '.btnModal', function() {
            let id = $(this).data('target');

            $.ajax({
                url: "{{url('data-aset/barcode')}}/" + id.replace('#barcode-', ''),
                type: 'GET',
                success: function(r) {
                    $('.imgbarcode').html(r);
                }
            });

            $('.modal').attr('id', id.replace('#', ''));
            let idAset = id.replace('#barcode-', '').replaceAll('-', '/');

            $('.modal-title').text(idAset);
            $('.noinventaris').text(idAset);
        });

        $('#btn-selects').click(() => {

            if($('#btn-selects').val() == '0'){
                $('.no').each((idx, elem) => {
                    $(elem).addClass('d-none');
                    $(elem).siblings('#div_ceklist').removeClass('d-none');
                });
                $('#btn-selects').attr('value', '1');
                
            }else{
                $('.no').each((idx, elem) => {
                    $(elem).removeClass('d-none');
                    $(elem).siblings('#div_ceklist').addClass('d-none');
                });
                $('#btn-selects').attr('value', '0');
            }

        });

        $('#btnPDF').click(() => {

            let data = [];

            $('.custom-control-input').each((idx, elem) => {
                if ($(elem).is(':checked')){
                    data.push($(elem).val());
                }
            });

            $.ajax({
                url: "{{url('cetak_pdf')}}",
                type: 'POST',
                data: {data:data, _token:"{{csrf_token()}}"},
                dataType: 'JSON',
                success: function(re){
                    console.log(re);
                }
            });

        });

        $('#ceklisAll').change(() => {
            if ($(this).is(":checked")) {
                $('.custom-checkbox').each((idx, elem) => {
                    console.log(elem);
                })
            }
        })

    });

    fetch();


    function fetch(start_date, end_date, pencarian) {
        $.ajax({
            url: "{{url('data-master')}}",
            type: 'GET',
            data: {
                start_date: start_date,
                end_date: end_date,
                pencarian: pencarian,
            },
            dataType: 'JSON',
            success: function(data) {

                totalData = data.aset.length;

                if (data.aset.length <= 0) {
                    toastr.warning("Pencarian " + pencarian + " tidak ditemukan");
                }

                var i = 1;
                var idx = 0;
                $('#tbMasterBarang').DataTable({
                    data: data.aset,
                    searching: false,
                    response: true,
                    columnDefs: [{
                        targets: [0],
                        orderable: false,
                    }],
                    columns: [{
                            render: function(data, type, row, meta) {
                                let elem = '<div class="custom-control custom-checkbox d-none" id="div_ceklist"><input class="custom-control-input" type="checkbox" id="Checkbox' + row.id_inventaris + '" value="' + row.id_inventaris + '"><label class="custom-control-label" for="Checkbox' + row.id_inventaris + '"></label></div>';
                                let elemno = '<span class="text-center no">' + i++ + '</span>';
                                return elem + elemno;
                            }
                        },
                        {
                            data: "id_inventaris",
                            render: (data, type, row, meta) => {
                                return '<a href="{{url("data-barang")}}/' + row.id_inventaris.replaceAll('/', '-') + '" class="text-decoration-none">' + row.id_inventaris + '</a>';
                            }
                        },
                        {
                            "data": "pengadaan",
                            "render": (data, type, row, meta) => {
                                return row.barang[0].pengadaan;
                            }
                        },
                        {
                            "render": (data, type, row, meta) => {
                                return row.barang[0].nama_merk;
                            }
                        },
                        {
                            "render": (data, type, row, meta) => {
                                if (row.keterangan == "stock baru") {
                                    return '<span class="badge badge-success">' + row.keterangan + '</span>';
                                }
                                if (row.keterangan == "stock lama") {
                                    return '<span class="badge badge-warning">' + row.keterangan + '</span>';
                                }
                                if (row.keterangan == "stock rusak") {
                                    return '<span class="badge badge-danger">' + row.keterangan + '</span>';
                                }
                            }
                        },
                        {
                            "render": (data, type, row, meta) => {
                                return '<button class="btn btn-outline-primary btnModal" data-toggle="modal" data-target="#barcode-' + row.id_inventaris.replaceAll('/', '-') + '"><i class="fa-solid fa-barcode"></i></button>'
                            }
                        },
                    ]
                });
            }
        });
        $('#btn-numb').click(() => {
            $('#btn-numb').attr('id', 'btn-selects');
            $('.ceklist').each((idx, elem) => {
                $(elem).hide();
            });
            $('.no').each((idx, elem) => {
                $(elem).show();
            });
        });
    }
</script>
@endsection
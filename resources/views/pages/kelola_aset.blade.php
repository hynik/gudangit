@extends('home')
@section('distribusi')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <span>Kelola Aset</span>
            </div>
            <div class="card-body">
    <table class="table table-hover responsive" id="tb_kelola_aset">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kode</th>
                <th>Invntaris</th>
                <th>Status</th>
                <th>Kondisi</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
<script>
    var index = 1;
    $.ajax({
        url: "{{url('data-master')}}",
        type: 'GET',
        dataType: 'JSON',
        success: function(res){
            $('#tb_kelola_aset').DataTable({
                data: res.aset,
                    response: true,
                    lengthMenu: [5, 10, 15],
                    columns:[
                        {
                            render: function(data, type, row, meta){
                                return index++;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return row.kat__barang[0].nama;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return row.kat__barang[0].kode;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return row.id_inventaris;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return row.status_barang.status;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return row.status_barang.kondisi;
                            }
                        },
                        {
                            render: function(data, type, row, meta){
                                return '<a href="{{url("data-barang")}}/' + row.id_inventaris.replaceAll('/', '-') + '" class="btn btn-primary">edit</a>';
                            }
                        }
                    ]
            });
        }
    });
</script>

@endsection
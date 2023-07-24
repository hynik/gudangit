@extends('home')
@section('pengaturan')
<div class="row">
    <div class="col">
        <table class="table table-hover responsive" id="tb_daftarPengguna">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username Masuk</th>
                    <th>Hak Akses</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('custom-script')

<script>
    var i = 1;
    $.ajax({
        url: "{{url('pengaturan/daftar-pengguna')}}",
        type: 'POST',
        data: {
            data: 'q',
            _token: "{{csrf_token()}}"
        },
        dataType: 'JSON',
        success: function(res) {

            $('#tb_daftarPengguna').DataTable({
                data: res.data_pengguna,
                columns: [{
                        render: function(data, type, row, meta) {
                            return i++;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return row.name;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return row.username;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return row.level_user[0].level;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return '<a class="btn btn-primary" href="{{url("pengaturan/pengguna")}}/'+row.userid+'/edit">Edit</a> <a class="btn btn-danger" href="{{url("pengaturan/pengguna")}}/'+row.userid+'/hapus">Hapus</a>';
                        }
                    },
                ]
            });
            // console.log(res.data_pengguna[0].username);
            // console.log(res.data_pengguna[0].level_user[0].level);
        }
    })
</script>

@endsection
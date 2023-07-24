@extends('home')
@section('tambahKat')

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
                        <form action="#" method="post" id="form-modal">
                            <input type="hidden" name="_token" id="_token">
                            <div class="form-group">
                                <label for="inputEmail4">Edit Kode Kategori Aset</label>
                                <input type="text" class="form-control" name="kode_kat" id="inputEmail4">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
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

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-sm table-responsive-sm" id="tbKat">
                    <thead>
                        <tr class="bg-primary">
                            <!-- <th scope="col">No</th> -->
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Kode</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <span>Tambah Kategori Aset</span>
            </div>
            <div class="card-body">
                <form action="{{url('master/tambah-kat')}}" method="POST" id="from_tambah_jenis">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-sm-4">
                            <label for="inputPassword5" class="form-label">Nama Kategori</label>
                            <input type="text" id="inputPassword5" name="nama_kategori" class="form-control" aria-labelledby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text">
                                <small>Silahkan memasukkan nama kategori dari aset baru.</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="inputPassword5" class="form-label">Kode Kategori</label>
                            <input type="text" id="inputPassword5" name="kode_kategori" class="form-control" aria-labelledby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text">
                                <small>Silahkan diisi singkatan yang cocok untuk nama kategori, sebagai inisial.</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="inputPassword5" class="form-label">ID Kategori (Optional)</label>
                            <input type="text" id="inputPassword5" name="id_kategori" class="form-control" aria-labelledby="passwordHelpBlock">
                            <div id="passwordHelpBlock" class="form-text">
                                <small>Jika sebelumnya sudah ada ID.</small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $(document).ready(function() {

        function tb_kategori() {
            var i = 1;

            $.ajax({
                url: "{{url('master/getKategori')}}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    data: 'id',
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    $('#tbKat').DataTable({
                        data: res.kategori,
                        searching: false,
                        response: true,
                        lengthMenu: [5, 10, 15],
                        columns: [
                            //     {
                            //     data: 'no',
                            //     render: function(data, type, row, meta){
                            //         return i++;
                            //     },
                            // },
                            {
                                data: 'id',
                                render: function(data, type, row, meta) {
                                    return row.id_kat;
                                },
                            },
                            {
                                data: 'nama',
                                render: function(data, type, row, meta) {
                                    return row.nama;
                                },
                            },
                            {
                                data: 'kode',
                                render: function(data, type, row, meta) {
                                    return row.kode + '/XXXX/XXX';
                                }
                            },
                            {
                                data: 'edit',
                                render: function(data, type, row, meta) {
                                    return '<button class="btn btn-outline-primary btnModal" data-toggle="modal" data-target="#edit_kategori_' + row.id_kat + '" data-id="' + row.id_kat + '">Edit</button> <button class="btn btn-outline-danger btnHapus" data-id="' + row.id_kat + '" disabled>Hapus</button>';
                                }
                            }
                        ]
                    })
                }
            });
        }

        // $('#form_tambah_jenis').submit(function(event){
        //     var formData = {
        //         _token: $("input[name='_token']").val(),
        //         nama_jenis: $('#nama_jenis').val(),
        //         kode_jenis: $('#kode_jenis').val()
        //     }

        //     $.ajax({
        //         url: "{{url('master/tambah-kat')}}",
        //         type: 'POST',
        //         dataType: 'JSON',
        //         encode: true,
        //         data: formData,
        //         success: function(res){
        //             toastr.success(res.respon);
        //         }
        //     }).done(function(data){
        //         console.log(data);
        //     });
        //     event.preventDefault();
        // });

        tb_kategori();

        $(document).on('click', '.btnHapus', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "{{url('master/hapusKategori')}}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_kat: id
                },
                dataType: 'JSON',
                success: function(res) {
                    toastr.warning("Kategori dengan ID " + id + " Telah Di Hapus.");
                    $('#tbKat').DataTable().destroy();
                    tb_kategori();
                }
            });

        });

    });

    $(document).on('click', '.btnModal', function() {
        let id = $(this).data('id');

        $.ajax({
            url: "{{url('master/getKategori')}}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_kat: id
            },
            dataType: 'JSON',
            success: function(res) {
                console.log(res)
                $('.modal').attr('id', 'edit_kategori_' + res.kategori.id_kat);
                $('.modal').modal('show');

                $('.modal-title').text(res.kategori.nama + ' ' + res.kategori.kode);
                $('#_token').attr('value', "{{ csrf_token() }}");
                $('#form-modal').attr('action', "{{url('master/editKategori')}}/" + res.kategori.id_kat);
            }
        });

    });
</script>
@endsection
@extends('home')
@section('formulir')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- <div class="card-header"></div> -->
            <div class="card-body">
                <table class="table table-hover responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Form PO</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar_po as $idx => $data)
                        <tr>
                            <td>{{++$idx}}</td>
                            <td>Formulir PO Bulan {{date_format($data->created_at, 'M Y')}}</td>
                            <td>{{date_format($data->created_at, 'd-m-Y')}}</td>
                            @if ($data->status_ap == 'disimpan')
                            <td><span class="badge badge-primary">{{$data->status_ap}}</span></td>
                            @elseif ($data->status_ap == 'proses persetujuan')
                            <td><span class="badge badge-info">{{$data->status_ap}}</span></td>
                            @elseif ($data->status_ap == 'ditunda')
                            <td><span class="badge badge-warning">{{$data->status_ap}}</span></td>
                            @elseif ($data->status_ap == 'pembelian')
                            <td><span class="badge badge-success">{{$data->status_ap}}</span></td>
                            @endif
                            @if (Request::segment(3) == 'aprov')
                                @if ($data->ap_pimpinan == 0 || $data->ap_ga == 0 || $data->ap_dir == 0)
                                    <form action="{{url('formulir/daftar/aprov')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_permintaan" value="{{$data->id_permintaan}}">
                                        <input type="hidden" name="aprov" value="{{session()->get('userCredential')[0]['id_departement']}}">
                                        <td><button type="submit" class="btn btn-sm btn-primary">Setujui</button></td>
                                    </form>
                                @elseif ($data->ap_dir == 1)
                                    <form action="{{url('formulir/daftar/aprov')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_permintaan" value="{{$data->id_permintaan}}">
                                        <input type="hidden" name="aprov" value="pembelian">
                                        <td><button type="submit" class="btn btn-sm btn-success">Pembelian</button></td>
                                    </form>
                                @endif
                            @elseif (Request::segment(3) == 'po')
                                @if (session()->get('userCredential')[0]['id_departement'] == 2 && $data->status_ap == 'pembelian')
                                    <form action="{{url('formulir/daftar/aprov')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_permintaan" value="{{$data->id_permintaan}}">
                                        <input type="hidden" name="aprov" value="selesai">
                                        <td><button type="submit" class="btn btn-sm btn-primary">Sudah dibeli</button></td>
                                    </form>
                                @elseif (session()->get('userCredential')[0]['id_departement'] !== 2)
                                    <form action="{{url('formulir/ajukan')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_permintaan" value="{{$data->id_permintaan}}">
                                        <td>
                                            <button <?= ($disabled != null) ? 'disabled' : '' ?> type="submit" class="btn btn-sm btn-{{($data->status_ap == 'ditunda') ? 'success' : (($data->status_ap == 'proses persetujuan') ? 'secondary' : 'primary')}}">{!!($data->status_ap == 'ditunda') ? '<i class="fa-regular fa-paper-plane"></i>' : '<i class="fa-solid fa-paper-plane"></i>'!!}</button>
                                            <a href="{{url('formulir/hapus')}}/{{$data->id_permintaan}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </form>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    @if (Request::segment(3) == 'po')
                    <tfoot>
                        @if ($disabled->status_ap == 'selesai')
                        <tr>
                            <th>#</th>
                            <th>Formulir PO Bulan {{date_format($disabled->created_at, 'M Y')}}</th>
                            <th>{{date_format($disabled->created_at, 'd-m-Y')}}</th>
                            <th><span class="badge badge-success">{{$disabled->status_ap}}</span></th>
                            <th><a href="{{url('formulir/terima')}}/{{$disabled->id_permintaan}}" class="btn btn-sm btn-success"><i class="fa-solid fa-thumbs-up"></i></a></th>
                        </tr>
                        @endif
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
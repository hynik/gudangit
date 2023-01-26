@extends('home')
@section('distribusi')
<div class="row">
    <div class="col">
        <p class="text-muted">
            Distribusi Barang
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <a href="{{url('/data-barang')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 mb-4">
                    
                        <i class="fa-solid fa-{{$dataSpesifik->jenisBarang[0]->nama}}  fa-10x"></i>
                    </div>
                    <div class="col">
                        <table class="table">
                            <tr>
                                <th>Inventaris</th>
                                <td>{{ $dataSpesifik->id_inventaris }}</td>
                            </tr>
                            <tr>
                                <th>Merk</th>
                                <td>{{$dataSpesifik->nama_merk}}</td>
                            </tr>
                            <tr>
                                <th>Distribusi Ke</th>
                                <td>
                                    <!-- {{dd($dataSpesifik)}} -->
                                    <select class="form-select" aria-label=".form-select-sm example">
                                        <option value="">Management</option>
                                        <option value="2">AL</option>
                                        <option value="3">AK</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
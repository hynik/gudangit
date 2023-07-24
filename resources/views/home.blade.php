@extends('layouts.mainlayout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @yield('beranda')
            @yield('data-barang')
            @yield('item-barang')
            @yield('distribusi')
            @yield('barang-masuk')
            @yield('databaru')
            @yield('tambahKat')
            @yield('formulir')
            @yield('pengaturan')
        </div>
    </section>
</div>
@endsection
@section('script-js')
@yield('custom-script')
@endsection

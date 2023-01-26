@extends('home')
@section('beranda')
<div class="row mb-3">
    <div class="col">
        <h1 class="text-muted">Selamat Datang Abdi Arkananta</h1>
        <h6 class="text-muted">Managemen Asset IT</h6>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right fa-flip-horizontal"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><a href="{{url('data-barang')}}" class="text-white text-decoration-none">Barang Keluar</a></span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><a href="{{url('data-barang')}}" class="text-white">Barang Masuk</a></span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fa-solid fa-boxes-stacked"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Stock</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fa-solid fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Rusak</span>
                <span class="info-box-number">41,410</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
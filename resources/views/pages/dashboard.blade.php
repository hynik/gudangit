@extends('home')
@section('beranda')
<div class="row mb-3">
    <div class="col">
        <h1 class="text-muted">Selamat Datang Abdi Arkananta</h1>
        <h6 class="text-muted">Managemen Asset IT</h6>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-6 col-sm-5 col-md-3">
        <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><a href="{{url('data-barang')}}" class="text-white">Aset Dalam Gudang</a></span>
                <span class="info-box-number">{{$countKat->on_stock}}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_on_stock ?>%"></div>
                </div>
                <span class="progress-description">
                    {{number_format($persentase_on_stock, 0)}} % Dari Keseluruhan Aset
                </span>
            </div>
        </div>
    </div>
    <!-- <div class="col-6 col-sm-4">
        <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fa-solid fa-boxes-stacked"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Aset Stock Lama Dalam Gudang</span>
                <span class="info-box-number"></span>
                <div class="progress">
                    <div class="progress-bar" style="width:%"></div>
                </div>
                <span class="progress-description">
                </span>
            </div>
        </div>
    </div> -->
    <div class="col-6 col-sm-5 col-md-3">
        <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fa-solid fa-boxes-stacked"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Aset Di Distribusikan</span>
                <span class="info-box-number">{{$countKat->distribusi}}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_distribusi ?>%"></div>
                </div>
                <span class="progress-description">
                    {{number_format($persentase_distribusi, 0)}} % Dari Keseluruhan Aset
                </span>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-5 col-md-3">
        <!-- <div class="col-md-3 col-sm-6 col-12"> -->
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fa-solid fa-arrows-turn-right fa-flip-horizontal"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><a href="{{url('data-barang')}}" class="text-white text-decoration-none">Aset Keluar Dari Gudang</a></span>
                <span class="info-box-number">{{$countKat->out_stock}}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_out_stock ?>%"></div>
                </div>
                <span class="progress-description">
                    {{number_format($persentase_out_stock, 0)}} % Dari Keseluruhan Aset
                </span>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-5 col-md-3">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fa-solid fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Aset Rusak Dalam Gudang</span>
                <span class="info-box-number">{{$countKat->rusak}}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $persentase_rusak ?>%"></div>
                </div>
                <span class="progress-description">
                    {{number_format($persentase_rusak, 0)}} % Dari Keseluruhan Aset
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Line Chart</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 463px;" width="463" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script src="{{url('adminlte/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script>
var areaChartCanvas = $('#lineChart').get(0).getContext('2d')
var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });
</script>

@endsection
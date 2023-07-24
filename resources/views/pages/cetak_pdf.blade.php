<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$title}}</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/custom.css')}}">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center">CETAK NOMOR IVENTARIS</h3>
                <p class="text-center">PT Sahabat Sakinah Senter</p>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-auto" id="generate">
                <!-- <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="2"><img src="https://sahabatsakinah.id/img/core-img/favicon.ico" alt="logo SSS" class="ml-1 mr-1">
                            <bold>INVENTARIS</bold>
                        </td>
                        <td rowspan="2" class="text-center"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG('h', 'C39', 1, 55)}}" alt="barcode" /></td>
                    </tr>
                    <tr>
                        <td>NO</td>
                        <td></td>
                    </tr>
                </table> -->
        </div>
    </div>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>
    <script>
        window.print();
    </script> -->
</body>

</html>
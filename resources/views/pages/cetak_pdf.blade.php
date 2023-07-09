<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            @foreach($data as $id_inventaris)
            <div class="col-auto">
                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="2"><img src="https://sahabatsakinah.id/img/core-img/favicon.ico" alt="logo SSS" class="ml-1 mr-1">
                            <bold>INVENTARIS</bold>
                        </td>
                        <td rowspan="2" class="text-center"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($id_inventaris, 'C39', 1, 55)}}" alt="barcode" /></td>
                    </tr>
                    <tr>
                        <td>NO</td>
                        <td>MS/0001/2023</td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
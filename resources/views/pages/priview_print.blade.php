@extends('home')
@section('barang-masuk')
<div class="row justify-content-md-center mb-3">
    <div class="col">
        <button type="button" id="save_pdf" class="btn btn-primary">Save PDF</button>
    </div>
</div>
<div class="row justify-content-md-center">
    @foreach($barcode as $key => $d)
    <input type="hidden" name="data[]" value="{{$id_inventaris[$key]}}">
    <div class="col-auto m-3" id="generate">
        <table class="table table-sm table-bordered">
            <tr>
                <td colspan="2"><img src="{{asset('logotok.png')}}" alt="logo SSS" class="ml-1 mr-1">
                    <bold>INVENTARIS</bold>
                </td>
                <td rowspan="2" class="text-center"><img class="m-3" src='data:image/png;base64,{{$d}}' alt='barcode' /></td>
            </tr>
            <tr>
                <td>NO</td>
                <td>{{$id_inventaris[$key]}}</td>
            </tr>
        </table>
    </div>
    @endforeach
</div>
@endsection
@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#save_pdf').click(function(){
        
        var data = [];

        $('input[name="data[]"]').each(function(i, e){
            data.push($(e).val());
        });

        $.ajax({
            url: "{{url('cetak/pdf')}}",
            type: 'GET',
            data: {
                data: data
            },
            success: (element) => {
                html2pdf()
                    .set({
                        html2canvas: {
                            scale: 4
                        }
                    })
                    .from(element)
                    .save();
            }
        });
    });
</script>

@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <section class="content">
        <div class="container">
            @yield('content')
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{url('adminlte/plugins/toastr/toastr.min.js')}}"></script>
    @if (!empty(session()->get('success')))
    <script>
            toastr.success("<?=session()->get('success')[0]?>");
    </script>
    <?php session()->now('success', session()->get('success')); ?>
    @elseif (!empty(session()->get('info')))
    <script>
            toastr.info("<?=session()->get('info')[0]?>");
    </script>
    <?php session()->now('info', session()->get('info')); ?>
    @elseif (!empty(session()->get('warning')))
    <script>
            toastr.warning("<?=session()->get('warning')[0]?>");
    </script>
    <?php session()->now('warning', session()->get('warning')); ?>
    @elseif (!empty(session()->get('error')))
    <script>
            toastr.error("<?=session()->get('error')[0]?>");
    </script>
    <?php session()->now('error', session()->get('error')); ?>
    @endif
</body>

</html>
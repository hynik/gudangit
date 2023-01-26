<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="hold-transition login-page">
    <section class="content">
        <div class="container">
            @yield('content')
        </div>
    </section>
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
</body>

</html>
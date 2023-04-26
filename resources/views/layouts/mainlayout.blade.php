<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('layouts.partials.nav')
    @include('layouts.partials.sidebar')
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
    @yield('script-js')
</body>
</html>
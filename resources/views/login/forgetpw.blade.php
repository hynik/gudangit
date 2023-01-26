@extends('login.template')
@section('content')
<div class="row justify-content-center">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">E Payment School mts Abadiyah</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Pemulihan Password. Gunakan email atau username sebagai id untuk mengganti password yang terbaru.</p>
                <form action="../../index3.html" method="post">
                    <div class="input-group mb-3">
                        <input type="name" class="form-control" placeholder="Email atau Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Pemulihan Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="forgot-password.html"><small>Halaman Login</small></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
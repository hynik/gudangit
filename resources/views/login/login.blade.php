@extends('login.template')
@section('content')
<div class="row justify-content-center">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Sistem Informasi Inventarisasi Barang</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Selamat Datang di Halaman Login</p>
                <form action="{{ url('login/attempt-login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Masuk ke Dashboard</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="forgot-password.html"><small>Lupa Kata Sandi?</small></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
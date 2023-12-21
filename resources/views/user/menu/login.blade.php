@extends('user/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <form action="{{ url('aksilogin/user') }}" method="POST">
                    @csrf
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ url('dashboard/tamudefault') }}" class="">
                                <h5 class="text-primary"><i class="fa fa-user-edit me-2"></i>Reservasi Online</h5>
                            </a>
                            <h5>Login</h5>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                Email / Password Salah
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                Silahkan Melakukan Login
                            </div>
                        @endif
                        @if (session()->has('success-reset-password'))
                            <div class="alert alert-success" role="alert">
                                Password Berhasil Diubah. Silahkan Melakukan Login
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email"
                                required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="password" required
                                placeholder="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="{{ url('daftar/user') }}">Daftar</a>
                            <a href="{{ url('lupapassword/user') }}">Lupa Password</a>
                        </div>
                        <div class="m-n2">
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
@endsection

@extends('user/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ url('dashboard/tamudefault') }}" class="">
                            <h5 class="text-primary"><i class="fa fa-user-edit me-2"></i>Reservasi Online</h5>
                        </a>
                        <h5>Daftar</h5>
                    </div>
                    <form action="{{ url('userstore/tamu') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="nik" id="nik" placeholder="nik"
                                required>
                            <label for="nik">NIK</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="nama"
                                required>
                            <label for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="no_wa" id="no_wa" placeholder="no_wa"
                                required>
                            <label for="no_wa">No WhatsApps</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat"
                                required>
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email"
                                required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="password" required>
                            <label for="password">Password</label>
                        </div>
                        <p class="text-center mb-4">Sudah Punya Akun? <a href="{{ url('login/user') }}">Login</a></p>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Sign In End -->
@endsection

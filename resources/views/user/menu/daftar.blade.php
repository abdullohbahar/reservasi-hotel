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
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" placeholder="nik" value="{{ old('nik') }}" required>
                            <label for="nik">NIK</label>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="nama" value="{{ old('nama') }}" required>
                            <label for="nama">Nama Lengkap</label>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control @error('no_wa') is-invalid @enderror" name="no_wa"
                                id="no_wa" placeholder="no_wa" value="{{ old('no_wa') }}" required>
                            <label for="no_wa">No WhatsApps</label>
                            @error('no_wa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" placeholder="alamat" value="{{ old('alamat') }}" required>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="email" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

@extends('user/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <form action="">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ url('dashboard/tamudefault') }}" class="">
                                <h6 class="text-primary"><i class="fa fa-user-edit me-2"></i>Reservasi Online</h6>
                            </a>
                            <h6>Lupa Passoword</h6>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" name="nama" id="email" placeholder="email"
                                required>
                            <label for="email">Email</label>
                        </div>
                        <div class="m-n2">
                            <p class="d-flex align-items-center justify-content-between mb-4">
                                <a href="{{ url('daftar/user') }}">Daftar</a>
                                <a href="{{ url('login/user') }}">Login</a>
                            </p>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
@endsection

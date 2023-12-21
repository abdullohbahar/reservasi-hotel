@extends('user/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <form action="{{ url('aksi-reset-password') }}" method="POST">
                    @csrf
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ url('dashboard/tamudefault') }}" class="">
                                <h6 class="text-primary"><i class="fa fa-user-edit me-2"></i>Reservasi Online</h6>
                            </a>
                            <h6>Reset Password</h6>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="password" required>
                            <label for="password">Masukkan Password Yang Baru</label>
                        </div>
                        <div class="m-n2">
                            <input type="hidden" name="token" value="{{ $token }}" id="">
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
@endsection

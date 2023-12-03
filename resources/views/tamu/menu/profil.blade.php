@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 px-5 border">
                <div class="text-center">
                    <h3 class="mt-5 mb-5">
                        Profil
                    </h3>
                    <img src="{{ url('Profil.jpeg') }}" alt="">
                    <div class="mt-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control form-control-sm" type="file" id="gambar">
                    </div>
                    <p class="mt-3">
                        <button class="btn btn-primary" href="">Simpan</button>
                    </p>
                </div>

            </div>
            <div class="col-xl-6 px-5 mt-5 mb-5">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" class="form-control" name="nik">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" class="form-control" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WhatsApp</label>
                        <input type="text" class="form-control" name="no_wa">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <p class="text-center" href="">
                        <button class="btn btn-primary">Simpan</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Absen</h1>
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
                                <a class="btn btn-primary" href="">Simpan</a>
                            </p>
                        </div>

                    </div>
                    <div class="col-xl-6 px-5 mt-5 mb-5">
                        <form action="">
                            <div class="mb-3">
                                <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="alamat">
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" class="form-control" id="no_wa">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                        </form>
                        <p class="text-center" href="">
                            <a class="btn btn-primary">Simpan</a>
                        </p>

                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection

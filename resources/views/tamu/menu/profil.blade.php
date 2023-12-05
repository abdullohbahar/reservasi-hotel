@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 px-5 border">
                <div class="text-center">
                    @if (session()->has('success-foto'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="mt-5 mb-5">
                        Profil
                    </h3>
                    <img src="{{ url("$tamu->gambar") }}" class="w-100" alt="">
                    <form action="{{ url('ubahfoto/tamu/' . $id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input class="form-control form-control-sm" type="file" required name="gambar"
                                id="gambar">
                        </div>
                        <p class="mt-3">
                            <button type="submit" class="btn btn-primary" href="">Simpan</button>
                        </p>
                    </form>
                </div>
            </div>
            <div class="col-xl-6 px-5 mt-5 mb-5">
                @if (session()->has('success-profile'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('ubahprofile/tamu/' . $id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" class="form-control" name="nik" value="{{ $tamu->nik }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="{{ $tamu->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" class="form-control" name="alamat" value="{{ $tamu->alamat }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No WhatsApp</label>
                        <input type="text" class="form-control" name="no_wa" value="{{ $tamu->no_wa }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $tamu->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="new-password">
                    </div>
                    <p class="text-center" href="">
                        <button class="btn btn-primary">Simpan</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

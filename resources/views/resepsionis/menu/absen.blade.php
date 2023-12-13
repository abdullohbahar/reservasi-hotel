@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Absen</h1>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('simpan-absen/resepsionis') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="card">
                                <div class="text-center">
                                    <h6 class="mb-4">
                                        Absen Resepsionis
                                    </h6>
                                    <select class="form-select" name="keterangan" aria-label="Default select example"
                                        required>
                                        <option value="" selected>Pilih Keterangan</option>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Izin">Izin</option>
                                    </select>
                                </div>
                                <div class=" mt-3 text-center">
                                    <p class="mb-3">Apakah sudah benar?</p>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

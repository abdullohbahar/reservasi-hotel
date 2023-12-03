@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Absen</h1>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="text-center">
                                <h6 class="mb-4">
                                    Absen Resepsionis
                                </h6>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Keterangan</option>
                                    <option value="1">Mr.A</option>
                                    <option value="2">Mr.B</option>
                                    <option value="3">Mr.C</option>
                                </select>
                            </div>
                            <div class=" mt-3 text-center">
                                <p class="mb-3">Apakah sudah benar?</p>
                                <p class="btn btn-primary">Submit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

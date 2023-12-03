@extends('resepsionis/layout/app')

@section('title')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main class="header">
            <div class="container-fluid px-4">
                <h3 class="mt-4 mb-4">List Kamar</h3>
                <div class="row">
                    <div class="col-xl-8 col-md-6">
                        <div class="card">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID-Kamar</th>
                                        <th>Nomor Kamar</th>
                                        <th>Tipe Kamar</th>
                                        <th>Status</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>AB-01</td>
                                        <td>A-01</td>
                                        <td>Tipe-A</td>
                                        <td>Null</td>
                                        <td>Null</td>
                                        <td>Null</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="text-center">
                                <h6 class="mb-4">
                                    Tamu Check-in
                                </h6>
                                <label for="no_booking" class="form-label">Nomor Booking</label>
                                <input type="id" id="no_booking" class="form-control">
                            </div>
                            <div class=" mt-3 text-center">
                                <p class="btn btn-primary">Check-In</p>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="text-center">
                                <h6 class="mb-4">
                                    Keterangan Tamu
                                </h6>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Nomor Kamar</option>
                                    <option value="1">Mr.A</option>
                                    <option value="2">Mr.B</option>
                                    <option value="3">Mr.C</option>
                                </select>
                            </div>
                            <div class=" mt-3 text-center">
                                <p class="mb-3">Pilih Konfirmasi</p>
                                <a href="{{ url('tamu/detail') }}" class="btn btn-warning">Detail</a>
                                <a href="" class="btn btn-success">Check-Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

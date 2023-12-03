@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Nomor Booking</h1>
                <div class="row">
                    <div class="col-xl-8 col-md-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No Booking</th>
                                            <th>Nama</th>
                                            <th>Tipe Kamar</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Total Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>AB-0001-CU</td>
                                            <td>Yusuf Murwido Hutomo</td>
                                            <td>Tipe-B</td>
                                            <td>12-04-2023</td>
                                            <td>12-06-2023</td>
                                            <td>1800000</td>
                                        </tr>
                                        <tr>
                                            <td>AB-0002-CU</td>
                                            <td>Adam Smith</td>
                                            <td>Tipe-A</td>
                                            <td>12-04-2023</td>
                                            <td>12-08-2023</td>
                                            <td>200000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="text-center">
                                <h6 class="mb-4">
                                    Konfirmasi Tamu (Batal)
                                </h6>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Nama Tamu</option>
                                    <option value="1">Mr.A</option>
                                    <option value="2">Mr.B</option>
                                    <option value="3">Mr.C</option>
                                </select>
                            </div>
                            <div class=" mt-3 text-center">
                                <p class="mb-3">Pilih Konfirmasi</p>
                                <p class="btn btn-warning">Hapus</p>
                                <p class="btn btn-secondary">Cancel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

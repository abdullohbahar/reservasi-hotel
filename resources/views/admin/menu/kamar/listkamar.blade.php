@extends('admin/layout/app')

@section('title')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main class="header">
            <div class="container-fluid px-4">
                <h3 class="mt-4 mb-4">List Kamar</h3>
                <div class="row">
                    <div class="col-xl-12 col-md-6">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID-Kamar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Nomor Kamar</th>
                                    <th>Status</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AB-01</td>
                                    <td>Tipe-A</td>
                                    <td>A-01</td>
                                    <td>Null</td>
                                    <td>Null</td>
                                    <td>Null</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

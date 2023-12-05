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
                                    <th>Gambar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Nomor Kamar</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamars as $kamar)
                                    <tr>
                                        <td>{{ $kamar->id }}</td>
                                        <td>
                                            <img src="{{ asset($kamar->gambar) }}" class="w-25" alt=""
                                                srcset="">
                                        </td>
                                        <td>{{ $kamar->tipe_kamar }}</td>
                                        <td>{{ $kamar->no_kamar }}</td>
                                        <td>{{ $kamar->harga }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

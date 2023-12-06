@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Content section-->
    <div class="card text-center">

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h3>
                Riwayat Booking
            </h3>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Booking</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Tipe Kamar</th>
                                <th>No Kamar</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $riwayat)
                                <tr>
                                    <td>
                                        {{ $riwayat->no_booking }}
                                    </td>
                                    <td>
                                        {{ $riwayat->checkin }}
                                    </td>
                                    <td>
                                        {{ $riwayat->checkout }}
                                    </td>
                                    <td>
                                        {{ $riwayat->tipe_kamar }}
                                    </td>
                                    <td>
                                        {{ $riwayat->no_kamar }}
                                    </td>
                                    <td>
                                        {{ $riwayat->harga }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a class="mb-4" href="{{ url('dashboard/tamu') }}">Kembali</a>
    </div>
@endsection

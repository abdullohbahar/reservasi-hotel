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
                                <th>Status Pembayaran</th>
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
                                    <td class="text-capitalize">
                                        @if ($riwayat->status_pembayaran == 'menunggu pembayaran')
                                            {{ $riwayat->status_pembayaran }} <br>
                                            <a href="{{ url('pembayaran/tamu/' . $riwayat->transaksi_id) }}"
                                                class="btn btn-warning pl-5">Bayar</a>
                                        @elseif($riwayat->status_pembayaran == 'tolak')
                                            Di{{ $riwayat->status_pembayaran }} <br>
                                            Alasan: {{ $riwayat->alasan }} <br>
                                            <a href="{{ url('pembayaran/tamu/' . $riwayat->transaksi_id) }}"
                                                class="btn btn-warning pl-5">Upload Bukti Pembayaran</a>
                                        @elseif($riwayat->status_pembayaran == 'dibayar')
                                            Sudah Dibayar <br>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url($riwayat->bukti_pembayaran) }}"
                                                    class="btn btn-success pl-5" target="_blank">Lihat
                                                    Bukti Pembayaran</a>
                                                <button type="button" class="btn btn-info">Unduh Struk Pembayaran</button>
                                            </div>
                                        @endif
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

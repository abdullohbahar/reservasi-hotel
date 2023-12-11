@extends('resepsionis/layout/app')

@section('title')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Nomor Booking</h1>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservasi as $reservasi)
                                            <tr>
                                                <td>{{ $reservasi->no_booking }}</td>
                                                <td>{{ $reservasi->nama_tamu }}</td>
                                                <td>{{ $reservasi->tipe_kamar }}</td>
                                                <td>{{ $reservasi->checkin }}</td>
                                                <td>{{ $reservasi->checkout }}</td>
                                                <td>{{ $reservasi->harga }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-success" id="confirm"
                                                            data-id="{{ $reservasi->id }}"
                                                            {{ $reservasi->status == 'pending' ? '' : 'hidden' }}>Konfirmasi</button>
                                                        <button type="button" class="btn btn-danger" id="tolak"
                                                            {{ $reservasi->status == 'pending' ? '' : 'hidden' }}
                                                            data-id="{{ $reservasi->id }}">Batal</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('addons-js')
    <script>
        console.log("x")
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("body").on("click", "#confirm", function() {
            var id = $(this).data("id");

            Swal.fire({
                title: "Apakah anda yakin?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../konfirmasi-nobooking/resepsions/' + id,
                        method: "GET",
                        dataType: "JSON",
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Berhasil Konfirmasi Data.",
                                    icon: "success"
                                });

                                setTimeout(() => {
                                    window.location.href = ""
                                }, 1000);

                            }
                        }
                    })
                }
            });
        })
    </script>
@endpush

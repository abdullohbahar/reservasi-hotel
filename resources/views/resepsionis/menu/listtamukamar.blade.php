@extends('resepsionis/layout/app')

@section('title')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main class="header">
            <div class="container-fluid px-4">
                <h3 class="mt-4 mb-4">List Kamar</h3>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Kamar</th>
                                        <th>Tipe Kamar</th>
                                        <th>Status</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($reservasi as $reservasi)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $reservasi->no_kamar }}</td>
                                            <td>{{ $reservasi->tipe_kamar }}</td>
                                            <td>{{ $reservasi->status }}</td>
                                            <td>{{ $reservasi->checkin }}</td>
                                            <td>{{ $reservasi->checkout }}</td>
                                            <td>
                                                <button class="btn btn-warning" id="confirm"
                                                    data-id="{{ $reservasi->id }}">Checkout</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        url: '../konifrmasi-checkout/resepsionis/' + id,
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

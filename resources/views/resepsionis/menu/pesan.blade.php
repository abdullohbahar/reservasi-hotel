@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Pesan Reservasi Online</h1>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tipe Kamar</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($reservasi as $reservasi)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $reservasi->nama_tamu }}</td>
                                                <td>{{ $reservasi->tipe_kamar }}</td>
                                                <td>{{ $reservasi->checkin }}</td>
                                                <td>{{ $reservasi->checkout }}</td>
                                                <td>{{ $reservasi->harga }}</td>
                                                <td class="text-capitalize">
                                                    {{ $reservasi->status }}
                                                    @if ($reservasi->status == 'tolak')
                                                        | {{ $reservasi->alasan }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if ($reservasi->bukti_pembayaran)
                                                            <a href="{{ url($reservasi->bukti_pembayaran) }}"
                                                                target="_blank" type="button" class="btn btn-info">Bukti
                                                                Pembayaran</a>
                                                        @else
                                                            -
                                                        @endif
                                                        <button type="button" class="btn btn-success" id="confirm"
                                                            data-id="{{ $reservasi->id }}"
                                                            {{ $reservasi->status == 'menunggu pembayaran' ? '' : 'hidden' }}>Konfirmasi</button>
                                                        <button type="button" class="btn btn-danger" id="tolak"
                                                            {{ $reservasi->status == 'menunggu pembayaran' ? '' : 'hidden' }}
                                                            data-id="{{ $reservasi->id }}">Tolak</button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('tolak-pesan/resepsionis') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Alasan</label>
                                <textarea name="alasan" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-danger" style="width: 100%">Tolak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addons-js')
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
                        url: '../konfirmasi-pesan/resepsionis/' + id,
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

        $("body").on("click", "#tolak", function() {

            $("#exampleModal").modal("show");

            var id = $(this).data("id")

            $("#id").val(id);
        })
    </script>

    @if (session()->has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
@endpush

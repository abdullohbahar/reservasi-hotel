@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Rerservasi Office</h1>
                <form action="{{ url('storetamu/resepsionis') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8 col-md-6">
                            <div class="card">

                                <h3 class="mb-4 text-center">
                                    Tamu
                                </h3>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" class="form-control" required name="nik"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" required name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="no_wa" class="form-label">No WhatsApp</label>
                                    <input type="text" class="form-control" required name="no_wa">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" required name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="alert alert-danger" role="alert" id="alert_full" hidden>
                                    Kamar Dengan Tipe Yang Dipilih Sudah penuh, harap cari tipe yang lainnya !
                                </div>
                                <h3 class="mb-4 text-center">
                                    Kamar
                                </h3>
                                <div class="mb-4 text-center">
                                    <label class="me-3 " for="datepicker">Check-In </label>
                                    <input type="date" id="checkin" name="checkin">
                                </div>
                                <div class="mb-4 text-center">
                                    <label class="me-2" for="datepicker">Check-Out </label>
                                    <input type="date" id="checkout" name="checkout">
                                </div>
                                <select class="form-select" name="tipe_kamar" aria-label="Default select example"
                                    id="tipeKamar" required>
                                    <option value="" selected>Pilih Tipe Kamar</option>
                                    @foreach ($tipekamar as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-4">
                                    <label class="form-label">Nomor Kamar</label>
                                    <input type="no_kamar" id="no_kamar" name="no_kamar" class="form-control" required
                                        readonly>
                                </div>
                                <input type="text" name="kamar_id" id="id_kamar" hidden>
                                <div class="mt-4">
                                    <label class="form-label">Total Biaya</label>
                                    <input type="text" id="total_biaya" name="total_biaya" class="form-control" required
                                        readonly placeholder="Rp. 0">
                                </div>
                                <p class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary" href="">Reservasi</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

@push('addons-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#tipeKamar").on("change", function() {
            var id = $(this).val();
            var checkin = $("#checkin").val()
            var checkout = $("#checkout").val()

            console.log("asdf")

            $.ajax({
                url: "../cekkamartersedia/" + checkin + "/" + checkout + "/" + id,
                method: "GET",
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    $("#no_kamar").val(response.nomor_kamar)
                    $("#total_biaya").val(response.harga)
                    $("#id_kamar").val(response.id_kamar)

                    if (response.jumlah_kamar < 1) {
                        $("#alert_full").attr("hidden", false)
                    } else {
                        $("#alert_full").attr("hidden", true)
                    }
                }
            })

            // console.log(id)

            // $.ajax({
            //     url: "/get-tipe-kamar-price/" + id,
            //     method: 'GET',
            //     dataType: 'JSON',
            //     success: function(response) {
            //         console.log(response)
            //         $("#totalPrice").val(response.price);
            //     }
            // })
        })
    </script>
@endpush

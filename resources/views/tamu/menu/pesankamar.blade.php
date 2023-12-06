@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ url('bookingkamar/tamu') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-6 px-5 border">
                    <div class="text-center">
                        <h4 class="mt-5 mb-5">
                            Pesan Kamar
                        </h4>
                        <div class="alert alert-danger" role="alert" id="alert_full" hidden>
                            Kamar Dengan Tipe Yang Dipilih Sudah penuh, harap cari tipe yang lainnya !
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="checkin">Check-In </label>
                            <input type="date" id="checkin" class="form-control" name="checkin">
                        </div>
                        <div class="mb-4">
                            <label for="checkout">Check-Out </label>
                            <input type="date" class="form-control" id="checkout" name="checkout">
                        </div>
                        <div class="mb-4">
                            <label for="">Tipe Kamar</label>
                            <select class="form-select" id="tipe_kamar" name="tipe_kamar_id"
                                aria-label="Default select example">
                                <option selected>Pilih Tipe Kamar</option>
                                @foreach ($tipekamar as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-info mb-3" id="cekKamar">Cek Kamar Tersedia</button>
                    </div>
                </div>
                <div class="col-xl-6 px-5 mt-5 mb-5" id="order" hidden>
                    <div class="mb-3">
                        <p class="mt-3 mb-3">
                            Nomor Kamar
                            <input class="form-control" type="text" id="nomor_kamar" name="nomor_kamar" readonly>
                        </p>
                        <p>
                            Total Biaya
                            <input class="form-control" type="text" id="total_biaya" name="total_biaya" readonly>
                        </p>
                        <input type="text" name="id_kamar" id="id_kamar" hidden>
                    </div>
                    <p class="text-center" href="">
                        <button class="btn btn-primary">Pesan</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('addons-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#cekKamar").on("click", function() {
            var checkin = $("#checkin").val()
            var checkout = $("#checkout").val()
            var tipeKamar = $("#tipe_kamar").val()

            $.ajax({
                url: "../cekkamartersedia/" + checkin + "/" + checkout + "/" + tipeKamar,
                method: "GET",
                dataType: "JSON",
                success: function(response) {
                    $("#nomor_kamar").val(response.nomor_kamar)
                    $("#total_biaya").val(response.harga)
                    $("#id_kamar").val(response.id_kamar)

                    if (response.jumlah_kamar < 1) {
                        $("#alert_full").attr("hidden", false)
                        $("#order").attr("hidden", true)
                    } else {
                        $("#alert_full").attr("hidden", true)
                        $("#order").attr("hidden", false)
                    }
                }
            })
        })
    </script>
@endpush

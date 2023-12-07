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
                Tata Cara Pembayaran :
            </h3>
            <p>
                1. Pilih bank tujuan
            </p>
            <p>
                2. Lakukan pembayaran sesuai dengan nominal ke nomor rekening yang tertera
            </p>
            <p>
                3. Upload bukti pembayaran
            </p>
        </div>

        <form action="{{ url('simpanpembayaran/tamu/' . $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body mt-4">
                <div class="row justify-content-center">
                    <div class="col-5">
                        <div class="form-group mt-3">
                            <label for="">Nominal Yang Harus Dibayarkan</label>
                            <input type="text" class="form-control" value="{{ $transaksi->total_biaya }}" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label>Pilih Bank</label>
                            <select name="metode_pembayaran" class="form-control" id="bank" required>
                                <option value="">-- Pilih Bank --</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Nomor Rekening</label>
                            <input type="text" name="norek" class="form-control" readonly id="norek">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" id="" required>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Upload Bukti Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <a class="mb-4" href="{{ url('dashboard/tamudefault') }}">Kembali</a>
    </div>
@endsection

@push('addons-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#bank").on("change", function() {
            var bank = $(this).val()

            if (bank == "BCA") {
                var norek = "1234567";
            } else if (bank == "BRI") {
                var norek = "89842";
            } else if (bank == "BNI") {
                var norek = "75757";
            } else {
                var norek = "";
            }

            $("#norek").val(norek)
        })
    </script>
@endpush

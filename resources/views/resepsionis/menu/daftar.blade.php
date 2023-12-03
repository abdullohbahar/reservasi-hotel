@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Rerservasi Office</h1>
                <form action="{{ url('storetamu/resepsionis') }}" method="POST">
                    <div class="row">
                        <div class="col-xl-8 col-md-6">
                            <div class="card">

                                <h3 class="mb-4 text-center">
                                    Tamu
                                </h3>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" class="form-control" name="nik" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="no_wa" class="form-label">No WhatsApp</label>
                                    <input type="text" class="form-control" name="no_wa">
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card">

                                <h3 class="mb-4 text-center">
                                    Kamar
                                </h3>
                                <div class="mb-4 text-center">
                                    <form action="submit_form.php" method="post">
                                        <label class="me-3 " for="datepicker">Check-In </label>
                                        <input type="date" name="chekin">
                                    </form>
                                </div>
                                <div class="mb-4 text-center">
                                    <form action="submit_form.php" method="post">
                                        <label class="me-2" for="datepicker">Check-Out </label>
                                        <input type="date" name="checkout">
                                    </form>
                                </div>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Tipe Kamar</option>
                                    @foreach ($tipekamar as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                    @endforeach
                                </select>
                                <fieldset disabled>
                                    <div class="mt-4">
                                        <label for="disabledTextInput" class="form-label">Status</label>
                                        <input type="text" id="disabledTextInput" class="form-control"
                                            placeholder="Free">
                                    </div>
                                    <div class="mt-4">
                                        <label for="disabledTextInput" class="form-label">Total Biaya</label>
                                        <input type="text" id="disabledTextInput" class="form-control"
                                            placeholder="Rp 180.000">
                                    </div>
                                </fieldset>
                                <p class="mt-4 text-center">
                                    <a class="btn btn-primary" href="">Reservasi</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 px-5 border">
                <div class="text-center">
                    <h4 class="mt-5 mb-5">
                        Pesan Kamar
                    </h4>
                    <div class="mb-4">
                        <form action="submit_form.php" method="post">
                            <label class="me-3 " for="datepicker">Check-In </label>
                            <input type="date" id="datepicker" name="datepicker">
                        </form>
                    </div>
                    <div class="mb-4">
                        <form action="submit_form.php" method="post">
                            <label class="me-2" for="datepicker">Check-Out </label>
                            <input type="date" id="datepicker" name="datepicker">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 px-5 mt-5 mb-5">
                <form action="">
                    <div class="mb-3">
                        <p class="mt-2">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih Tipe Kamar</option>
                                @foreach ($tipekamar as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p class="mt-3 mb-3">
                            Status Kamar
                            <input class="form-control" type="text" value="Full" aria-label="Disabled input example"
                                disabled readonly>
                        </p>
                        <p>
                            Total Biaya
                            <input class="form-control" type="text" value="Rp 180.000"
                                aria-label="Disabled input example" disabled readonly>
                        </p>
                    </div>
                </form>
                <p class="text-center" href="">
                    <a class="btn btn-primary">Pesan</a>
                </p>
            </div>
        </div>
    </div>
@endsection

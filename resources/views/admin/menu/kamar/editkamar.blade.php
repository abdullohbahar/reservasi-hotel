@extends('admin/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main class="header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-xl-4 col-md-6">
                        <form action="{{ url('storekamar/admin') }}" method="POST">
                            @csrf
                            <h4 class="text-center mt-3 mb-3">
                                Tambah Kamar
                            </h4>
                            <p class="mt-2">
                                <select class="form-select" aria-label="Default select example" name="tipe_kamar_id">
                                    <option selected>Pilih Tipe Kamar</option>
                                    @foreach ($tipekamar as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <div class="mt-3">
                                <label for="no_kamar" class="form-label">No Kamar</label>
                                <input type="text" class="form-control" name="no_kamar">
                            </div>
                            <p class="text-center mt-3" href="">
                                <button class="btn btn-primary">Simpan</button>
                            </p>
                        </form>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <h4 class="text-center mt-3 mb-4">
                            Tambah Tipe Kamar
                        </h4>
                        <form action="{{ url('storetipekamar/admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Tipe_kamar" class="form-label">Tipe Kamar</label>
                                <input type="text" name="tipe_kamar" class="form-control" id="Tipe_kamar">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" class="form-control" id="harga">
                            </div>
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas</label>
                                <input type="text" name="fasilitas" class="form-control" id="fasilitas">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input class="form-control" name="gambar" type="file" id="gambar">
                            </div>
                            <p class="text-center" href="">
                                <button class="btn btn-primary">Simpan</button>
                            </p>
                        </form>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div>
                            <h4 class="text-center mt-3 mb-4">
                                Hapus Kamar
                            </h4>
                            <select class="form-select" aria-label="Default select example" id="SelectDeleteNoKamar">
                                <option selected>Pilih Nomor Kamar</option>
                                @foreach ($no_kamar as $item)
                                    <option value="{{ $item->id }}">{{ $item->no_kamar }}</option>
                                @endforeach
                            </select>
                            <p class="mt-3">
                                Apakah sudah benar ?
                                <button class="btn btn-danger btn-sm" id="DeleteNoKamar">Hapus</button>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-center mt-3 mb-4">
                                Hapus Tipe Kamar
                            </h4>
                            <select class="form-select" aria-label="Default select example" id="SelectDeleteTipeKamar">
                                <option selected>Pilih Tipe Kamar</option>
                                @foreach ($tipekamar as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                @endforeach
                            </select>
                            <p class="mt-3">
                                Apakah sudah benar ?
                                <button class="btn btn-danger btn-sm" id="DeleteTipeKamar">Hapus</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Body-->
        <main class="Body">
            <div class="p-3 mb-2 bg-dark text-white text-center">EDIT</div>
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ url('updatenokamar/admin') }}" method="POST">
                            @csrf
                            <h4 class="text-center mt-3 mb-3">
                                Nomor Kamar
                            </h4>
                            <p class="mt-2">
                                <select class="form-select" name="id" aria-label="Default select example">
                                    <option selected>Pilih No Kamar</option>
                                    @foreach ($no_kamar as $item)
                                        <option value="{{ $item->id }}">{{ $item->no_kamar }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <div class="mt-3">
                                <label for="no_kamar" class="form-label">Ganti No Kamar</label>
                                <input type="text" class="form-control" name="no_kamar">
                            </div>
                            <p class="text-center mt-3" href="">
                                <button class="btn btn-primary">Update</button>
                            </p>
                        </form>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ url('updatetipekamar/admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-center mt-3 mb-3">
                                Tipe Kamar
                            </h4>
                            <p class="mt-2">
                                <select id="selectupdatetipekamar" class="form-select" name="id"
                                    aria-label="Default select example">
                                    <option selected>Pilih Tipe Kamar</option>
                                    @foreach ($tipekamar as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_kamar }}</option>
                                    @endforeach
                                </select>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="updateharga" name="harga">
                            </div>
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas</label>
                                <input type="text" class="form-control" id="updatefasilitas" name="fasilitas">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="updategambar" name="gambar">
                            </div>
                            </p>
                            <p class="text-center mt-3" href="">
                                <button class="btn btn-primary">Simpan</button>
                            </p>
                        </form>
                    </div>
                </div>
        </main>
    </div>
@endsection

@push('addons-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('meta[name="csrf-token"]').attr('content')


        $("#DeleteNoKamar").on("click", function() {
            var id = $("#SelectDeleteNoKamar").val();

            console.log(id)

            $.ajax({
                url: "/destroynokamar/" + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    alert("berhasil menghapus")
                }
            })
        })
        $("#DeleteTipeKamar").on("click", function() {
            var id = $("#SelectDeleteTipeKamar").val();

            console.log(id)

            $.ajax({
                url: "/destroytipekamar/" + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    alert("berhasil menghapus")
                }
            })
        })



        $("#selectupdatetipekamar").on("change", function() {
            var id = $(this).val();

            $.ajax({
                url: "/get-tipekamar/" + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $("#updateharga").val(response.TipeKamar.harga)
                    $("#updatefasilitas").val(response.TipeKamar.fasilitas)
                }
            })
        })
    </script>
@endpush

@extends('admin/layout/app')

@section('title')
@endsection


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-xl-4 col-md-6">
                        <form action="{{ url('storeresepsionis/admin') }}" method="POST">
                            @csrf
                            <h4 class="text-center mt-3 mb-4">
                                Tambah Resepsionis
                            </h4>
                            <div class="mb-3">
                                <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" name="nik" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" name="alamat" class="form-control" id="alamat">
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" name="no_wa" class="form-control" id="no_wa">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <p class="text-center" href="">
                                <button class="btn btn-primary">Simpan</button>
                            </p>
                        </form>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <h4 class="text-center mt-3 mb-4">
                            Edit Resepsionis
                        </h4>
                        <form action="{{ url('updateresepsionis/admin') }}" method="POST">
                            @csrf
                            <select class="form-select mb-3" id="selectResepsionis" aria-label="Default select example">
                                <option selected>Pilih Nama Resepsionis</option>
                                @foreach ($resepsionisedit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="editid" class="form-control" name="id">

                            <div class="mb-3">
                                <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                                <input type="text" id="editNIK" class="form-control" name="nik">
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">Nama Lengkap</label>
                                <input type="text" id="editNama" class="form-control" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" id="editAlamat" class="form-control" name="alamat">
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" id="editNoWa" class="form-control" name="no_wa">
                            </div>
                            <p class="text-center" href="">
                                <button class="btn btn-warning">Update</button>
                            </p>
                        </form>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <h4 class="text-center mt-3 mb-4">
                            Hapus Resepsionis
                        </h4>
                        <p>
                            Nama Resepsionis
                        </p>
                        <select class="form-select" aria-label="Default select example" id="selectDeleteResepsionis">
                            <option selected>Pilih Nama Resepsionis</option>
                            @foreach ($resepsionisedit as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <p class="mt-3">
                            Apakah sudah benar ?
                            <button class="btn btn-danger btn-sm" id="deleteResepsionis">Hapus</button>
                        </p>
                    </div>
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


        $("#selectResepsionis").on("change", function() {
            var id = $(this).val();

            $.ajax({
                url: "/get-resepsionis/" + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $("#editid").val(response.resepsionis.id)
                    $("#editNIK").val(response.resepsionis.nik)
                    $("#editNama").val(response.resepsionis.nama)
                    $("#editAlamat").val(response.resepsionis.alamat)
                    $("#editNoWa").val(response.resepsionis.no_wa)
                }
            })
        })

        $("#deleteResepsionis").on("click", function() {
            var id = $("#selectDeleteResepsionis").val();

            console.log(id)

            $.ajax({
                url: "/destroyresepsionis/" + id,
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    alert("berhasil menghapus")
                }
            })
        })
    </script>
@endpush

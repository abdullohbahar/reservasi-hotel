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
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                    id="" value="{{ old('nik') }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama"
                                    class="form-control  @error('nama') is-invalid @enderror" id="nama"
                                    value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" name="alamat"
                                    class="form-control  @error('alamat') is-invalid @enderror" id="alamat"
                                    value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" name="no_wa"
                                    class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                                    value="{{ old('no_wa') }}">
                                @error('no_wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <input type="text" id="editNIK"
                                    class="form-control  @error('editnik') is-invalid @enderror" name="editnik">
                                @error('editnik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">Nama Lengkap</label>
                                <input type="text" id="editNama"
                                    class="form-control @error('editnama') is-invalid @enderror" name="editnama">
                                @error('editnama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" id="editAlamat"
                                    class="form-control @error('editalamat') is-invalid @enderror" name="editalamat">
                                @error('editalamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input type="text" id="editNoWa"
                                    class="form-control @error('editno_wa') is-invalid @enderror" name="editno_wa">
                                @error('editno_wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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

            if (!id) {
                alert('Pilih Resepsionis');
            }

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

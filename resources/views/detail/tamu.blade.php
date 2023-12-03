<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hotel Bale Catur Inn | Detail Kamar</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('blog-assets/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('blog-assets/css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-brand">
                Hotel Bale Catur Inn | Detail Kamar
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-6 px-5 border mt-5">
                <div class="text-center mt-5">
                    <img src="{{ url('Profil.jpeg') }}" alt="">
                    <p class="mt-4">Yusuf Murwido Hutomo</p>
                </div>
            </div>

            <div class="col-xl-6 px-5 border mt-5">
                <div class="mb-4">
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check-In</label>
                        <input type="email" class="form-control" id="check_in" placeholder="12-Desember-2023">
                    </div>
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check-out</label>
                        <input type="email" class="form-control" id="check_out" placeholder="14-Desember-2023">
                    </div>
                    <div class="mb-3">
                        <label for="no_kamar" class="form-label">No Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" placeholder="A-01">
                    </div>
                    <div class="mb-3">
                        <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                        <input type="text" class="form-control" id="tipe_kamar" placeholder="Tipe-A">
                    </div>
                    <div class="mb-3">
                        <label for="pembayaran" class="form-label">Total Biaya</label>
                        <input type="text" class="form-control" id="pembayaran" placeholder="Rp 100.000">
                    </div>
                    <p class="text-center">
                        <a href="{{ url('list/resepsionis') }}" class="btn btn-primary">Kembali</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('blog-assets/js/scripts.js') }}"></script>
</body>

</html>

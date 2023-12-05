<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hotel Bale Catur Inn</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('landing-assets/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing-assets/css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Hotel Bale Catur Inn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ url('dashboard/tamu') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('profil/tamu') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('pesankamar/tamu') }}">Pesan Kamar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('pembayaran/tamu') }}">Pembayaran</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-warning">
        <div class="text-center my-5">
            <h1 class=" fs-3 fw-bolder mb-4">Selamat Datang</h1>
            @php
                $profile = session('user')->gambar ?? 'Profil.jpeg';
            @endphp
            <img class="img-fluid rounded-circle mb-4" style="width: 250px !important;" src="{{ url("$profile") }}"
                alt="..." />
            <p class=" mb-0">{{ session('user')->nama }}</p>
            <div class="mt-4">

                <a href="" class="btn btn-primary" type="submit">Riwayat</a>
                <a href="{{ url('login/user') }}" class="btn btn-success" type="submit">Logout</a>
            </div>
        </div>

    </header>
    @yield('content')
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <h4 class="mb-4 text-center text-white">Kontak</h4>
            <div class="text-center me-2">
                <a class="icon-link " href="#">
                    <img src="{{ url('IG.jpg') }}" class="rounded-circle me-2" style="width: 40px; height: 40px;"
                        alt="">
                    @HotelBaleCaturInn
                </a>
                <a class="icon-link " href="#">
                    <img src="{{ url('tiktok.jpeg') }}" class="rounded-circle me-2" style="width: 40px; height: 40px;"
                        alt="">
                    @HotelBaleCaturInn
                </a>
                <a class="icon-link " href="#">
                    <img src="{{ url('WA.jpg') }}" class="rounded-circle me-2" style="width: 40px; height: 40px;"
                        alt="">
                    08xx-xxxx-xxxx
                </a>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landing-assets/js/scripts.js') }}"></script>
</body>

</html>

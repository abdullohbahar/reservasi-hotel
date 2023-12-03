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
    <div class="container mt-5">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-9">
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="{{ url($tipe_kamar->gambar) }}"
                            alt="..." /></a>
                    <div class="card-body">
                        <h3 class="small text-muted">
                            Post :
                            <a class="small text-muted me-2">{{ $tipe_kamar->created_at }}</a>
                        </h3>
                        <div class="text-center mt-3">
                            <h3>
                                <strong>{{ $tipe_kamar->tipe_kamar }}</strong>
                            </h3>
                            <p class="text-danger">
                                Rp {{ $tipe_kamar->harga }}
                            </p>
                        </div>
                        <div class="mt-5">
                            <p>
                                Fasilitas: {{ $tipe_kamar->fasilitas }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-3">
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header text-center">Kategori Tipe Kamar</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($tipekamar as $item)
                                        <li><a href="{{ url('kamar/detail/' . $item->id) }}">{{ $item->tipe_kamar }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ url('pesankamar/tamu') }}" class="btn btn-primary" type="button">Pesan Kamar</a>
                    <a href="{{ url('dashboard/tamu') }}" class="btn btn-primary" type="button">Dashboard</a>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('blog-assets/js/scripts.js') }}"></script>
</body>

</html>

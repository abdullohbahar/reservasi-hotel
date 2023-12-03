@extends('tamu/layout/appdefault')

@section('title')
@endsection

@section('content')
    <!-- Content section-->
    <div class="container-fluid bg-secondary">
        <section class="py-5">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" aria-current="true"
                        class="active" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <div>
                            <h1>
                                Tipe-A
                            </h1>
                            <p class="fs-1 mt-2 text-danger">
                                Rp 100.000
                            </p>
                            <a href="{{ url('kamar/detail') }}" class="btn btn-success">Detail</a>
                        </div>

                        <img src="{{ url('TypeA.jpg') }}" class="mb-3 mt-4" style="width:50%" alt="...">
                    </div>
                    <div class="carousel-item">
                        <div>
                            <h1>
                                Tipe-B
                            </h1>
                            <p class="fs-1 mt-2 text-danger">
                                Rp 150.000
                            </p>
                            <button class="btn btn-success" href="{{ url('kamar/detail') }}">Detail</button>
                        </div>
                        <img src="{{ url('TypeB.jpg') }}" class=" mb-3 mt-4"style="width:50%" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </section>
    </div>
@endsection

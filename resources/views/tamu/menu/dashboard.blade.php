@extends('tamu/layout/app')

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
                    @foreach ($tipekamar as $key => $item)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div>
                                <h1>
                                    {{ $item->tipe_kamar }}
                                </h1>
                                <p class="fs-1 mt-2 text-danger">
                                    {{ $item->harga }}
                                </p>
                                <a href="{{ url('kamar/detail/' . $item->id) }}" class="btn btn-success">Detail</a>
                            </div>
                            <img src="{{ asset($item->gambar) }}" class="mb-3 mt-4" style="width:50%" alt="...">
                        </div>
                    @endforeach
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

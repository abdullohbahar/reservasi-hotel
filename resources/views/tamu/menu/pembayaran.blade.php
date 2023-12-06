@extends('tamu/layout/app')

@section('title')
@endsection

@section('content')
    <!-- Content section-->
    <div class="card text-center">

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h3>
                Tata Cara Pembayaran :
            </h3>
            <p>
                1. melakukan
            </p>
            <p>
                2. asdasd
            </p>
        </div>
        <a class="mb-4" href="{{ url('dashboard/tamudefault') }}">Kembali</a>
    </div>
@endsection

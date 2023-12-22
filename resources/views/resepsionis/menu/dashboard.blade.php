@extends('resepsionis/layout/app')

@section('title')
@endsection


@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Dashboard</h1>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            \Carbon\Carbon::setLocale('id');
                                        @endphp
                                        @foreach ($pendapatan as $result)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ \Carbon\Carbon::parse($result->Bulan)->translatedFormat('F') }}</td>
                                                <td>{{ $result->Tahun }}</td>
                                                <td>Rp {{ number_format($result->TotalBiaya, 0, '', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Tipe Kamar (Bulan ini)
                            </div>
                            <div class="card-body">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('addons-js')
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>

    <script>
        window.onload = function() {
            var options = {
                title: {
                    text: "Pendapatan Tipe Kamar"
                },
                animationEnabled: true,
                data: [{
                    type: "pie",
                    startAngle: 40,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}%",
                    dataPoints: {!! $dataCanvasJs !!} // Menggunakan data yang dikirimkan dari controller
                }]
            };
            $("#chartContainer").CanvasJSChart(options);
        }
    </script>
@endpush

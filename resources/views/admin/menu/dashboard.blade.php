@extends('admin/layout/app')

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
                                        <tr>
                                            <td>1</td>
                                            <td>Januari</td>
                                            <td>2023</td>
                                            <td>Rp 100.000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Februari</td>
                                            <td>2023</td>
                                            <td>Rp 150.000</td>
                                        </tr>
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
                    dataPoints: [{
                            y: 48.36,
                            label: "Tipe A"
                        },
                        {
                            y: 26.85,
                            label: "Tipe B"
                        },
                        {
                            y: 1.49,
                            label: "Tipe C"
                        },
                        {
                            y: 6.98,
                            label: "Tipe D"
                        },
                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

        }
    </script>
@endpush

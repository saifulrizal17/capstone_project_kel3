@extends('layouts.master')

@section('addCss')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info All -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Saldo Keseluruhan</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($balanceAll, 2, ',', '.') }}</h3>


                            </span>

                            <a href="#" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-arrow-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pendapatan Keseluruhan</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($incomeAll, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-arrow-down"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengeluran Keseluruhan</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($expenseAll, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Info Mouth -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Saldo Bulan Ini </span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($balanceMonthNow, 2, ',', '.') }}</h3>


                            </span>

                            <a href="#" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-arrow-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pendapatan Bulan Ini</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($incomeMonthNow, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-arrow-down"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengeluran Bulan Ini</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($expenseMonthNow, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Info Today -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Saldo Hari Ini </span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($balanceTodayNow, 2, ',', '.') }}</h3>


                            </span>

                            <a href="#" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-arrow-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pendapatan Hari Ini</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($incomeTodayNow, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-arrow-down"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengeluran Hari Ini</span>
                            <span class="info-box-number">
                                <h3>Rp. {{ number_format($expenseTodayNow, 2, ',', '.') }}</h3>

                            </span>

                            <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail<i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <div class="card height-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-chart-pie mr-1"></i>
                                Grafik Arus Kas
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="">
                                    <canvas id="arukasMyChart" height="240"></canvas>
                                </div>
                                <div class="col-md-3">
                                    <ul class="chart-legend clearfix">
                                        <li style="color: #f56954"><i class="far fa-circle"></i> Saldo</li>
                                        <li style="color: #00a65a"><i class="far fa-circle"></i> Pendapatan</li>
                                        <li style="color: #f39c12"><i class="far fa-circle"></i> Pengeluaran</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card height-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-chart-bar mr-1"></i>
                                Grafik Laba Rugi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="">
                                    <canvas id="labarugiMyChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-lg-6 connectedSortable">
                    <div class="card height-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-chart-pie mr-1"></i>
                                Grafik Keseluruhan Perubahan Modal
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="">
                                    <canvas id="perubahanmodalMyChart" height="240"></canvas>
                                </div>
                                <div class="col-md-3">
                                    <ul class="chart-legend clearfix">
                                        <li style="color: rgba(255, 99, 132, 0.7)"><i class="far fa-circle"></i> Aset
                                        </li>
                                        <li style="color: rgba(54, 162, 235, 0.7)"><i class="far fa-circle"></i> Kewajiban
                                        </li>
                                        <li style="color: rgba(255, 206, 86, 0.7)"><i class="far fa-circle"></i> Ekuitas
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card height-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-chart-line mr-1"></i>
                                Grafik Neraca
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="">
                                    <canvas id="neracaMyChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
@endsection

@section('addJavascript')
    @if (session('alert'))
        @php
            $alert = session('alert');
            $userName = Auth::user()->name;
            $appName = config('app.name');
        @endphp
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ $alert['title'] }}",
                    html: "Selamat Datang, <span style='color: 007bff;'>{{ $userName }}</span>, Di Website <span style='color: 007bff;'>{{ $appName }}</span>",
                    imageUrl: "{{ $alert['imageUrl'] }}",
                    imageAlt: "{{ $alert['imageAlt'] }}",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                });
            });
        </script>
    @endif
    <script>
        var ctx = document.getElementById('perubahanmodalMyChart').getContext('2d');
        var neracaMyChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($labelspm) !!},
                datasets: [{
                    data: {!! json_encode($values) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var arukasMyChartCanvas = document.getElementById("arukasMyChart").getContext("2d");

            var arukasMyChartData = {
                labels: ["Saldo", "Pendapatan", "Pengeluaran"],
                datasets: [{
                    data: [
                        {{ $balanceAll }},
                        {{ $incomeAll }},
                        {{ $expenseAll }},
                    ],
                    backgroundColor: ["#f56954", "#00a65a", "#f39c12"],
                }],
            };

            var arukasMyChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            var arukasMyChart = new Chart(arukasMyChartCanvas, {
                type: "doughnut",
                data: arukasMyChartData,
                options: arukasMyChartOptions,
            });
        });
    </script>
    <script>
        var ctx = document.getElementById('labarugiMyChart').getContext('2d');
        var labarugiMyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labaRugiLabels) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($labaRugiPendapatan) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Pengeluaran',
                    data: {!! json_encode($labaRugiPengeluaran) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('neracaMyChart').getContext('2d');
        var neracaMyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($neracaLabels) !!},
                datasets: [{
                        label: 'Aset',
                        data: {!! json_encode($neracaAset) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Kewajiban',
                        data: {!! json_encode($neracaKewajiban) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Ekuitas',
                        data: {!! json_encode($neracaEkuitas) !!},
                        backgroundColor: 'rgba(255, 255, 0, 0.2)',
                        borderColor: 'rgba(255, 255, 0, 1)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>
@endsection

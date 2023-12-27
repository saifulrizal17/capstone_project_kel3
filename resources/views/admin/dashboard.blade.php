@extends('layouts.master')

@section('addCss')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Rp. {{ number_format($balanceAll, 2, ',', '.') }}</h3>
                            <p>Saldo Keseluruhan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-balance-scale"></i>
                        </div>
                        <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="color-light text-white">
                                Rp. {{ number_format($incomeAll, 2, ',', '.') }}
                            </h3>
                            <p class="text-white">Pendapatan Keseluruhan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-arrow-up "></i>
                        </div>
                        <a href="{{ route('aruskas.index') }}" class="small-box-footer"><span
                                class="text-white">Detail</span>
                            <i class="fa fa-arrow-circle-right text-white"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp. {{ number_format($expenseAll, 2, ',', '.') }}</h3>
                            <p>Pengeluaran Keseluruhan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-arrow-down"></i>
                        </div>
                        <a href="{{ route('aruskas.index') }}" class="small-box-footer">Detail <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $percentageActiveUsers }}<sup style="font-size: 20px">%</sup></h3>
                            <p>User Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">Detail <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User Aktif</span>
                            <span class="info-box-number">{{ $totalActiveUsers }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User Mati</span>
                            <span class="info-box-number">{{ $totalDieUsers }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-fuchsia elevation-1"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Admin</span>
                            <span class="info-box-number">{{ $totalAdmins }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-pink elevation-1"><i class="fa fa-eye"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User</span>
                            <span class="info-box-number">{{ $totalUsers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <div class="card height-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-chart-pie mr-1"></i>
                                Grafik Keseluruhan Arus Kas
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="">
                                    <canvas id="aruskasMyChart" height="240"></canvas>
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
                                Grafik Keseluruhan Laba Rugi
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
                                Grafik Keseluruhan Neraca
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <canvas id="neracaMyChart" height="180"></canvas>
                            </div>
                            </ </div>
                </section>
            </div>
        </div>
    </section>
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
            var aruskasMyChartCanvas = document.getElementById("aruskasMyChart").getContext("2d");

            var aruskasMyChartData = {
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

            var aruskasMyChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            var aruskasMyChart = new Chart(aruskasMyChartCanvas, {
                type: "doughnut",
                data: aruskasMyChartData,
                options: aruskasMyChartOptions,
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
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                    borderColor: 'rgba(0, 128, 0, 1)',
                    borderWidth: 1
                }, {
                    label: 'Pengeluaran',
                    data: {!! json_encode($labaRugiPengeluaran) !!},
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderColor: 'rgba(255, 165, 0, 1)',
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
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Kewajiban',
                        data: {!! json_encode($neracaKewajiban) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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

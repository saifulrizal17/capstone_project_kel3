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

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Rp. {{ number_format($balanceAll, 2) }}</h3>
                            <p>Balance All</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-balance-scale"></i> <!-- Updated icon class -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Rp. {{ number_format($incomeAll, 2) }}</h3>
                            <p>Income All</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-arrow-up"></i> <!-- Updated icon class for income -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp. {{ number_format($expenseAll, 2) }}</h3>
                            <p>Expense All</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-arrow-down"></i> <!-- Updated icon class for expense -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Additional Cards for Admin -->
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
                            <span class="info-box-text">Total Admin</span>
                            <span class="info-box-number">{{ $totalAdmins }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-fuchsia elevation-1"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User</span>
                            <span class="info-box-number">{{ $totalUsers }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-pink elevation-1"><i class="fa fa-eye"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pengunjung</span>
                            <span class="info-box-number">{{ $totalVisitors }}</span>
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
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart">
                                    <canvas id="pieChart" height="240"></canvas>
                                </div>
                                <div class="col-md-3">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="far fa-circle text-danger"></i> Ballance All</li>
                                        <li><i class="far fa-circle text-success"></i> Income All</li>
                                        <li><i class="far fa-circle text-warning"></i> Expense All</li>
                                    </ul>
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
                                Grafik Keseluruhan Laba Rugi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart">
                                    <canvas id="myChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('addJavascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pieChartCanvas = document.getElementById("pieChart").getContext("2d");

            var pieChartData = {
                labels: ["Ballance All", "Income All", "Expense All"],
                datasets: [{
                    data: [
                        {{ $balanceAll }},
                        {{ $incomeAll }},
                        {{ $expenseAll }},
                    ],
                    backgroundColor: ["#f56954", "#00a65a", "#f39c12"],
                }],
            };

            var pieChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            var pieChart = new Chart(pieChartCanvas, {
                type: "doughnut",
                data: pieChartData,
                options: pieChartOptions,
            });
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($pendapatan) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Pengeluaran',
                    data: {!! json_encode($pengeluaran) !!},
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
@endsection

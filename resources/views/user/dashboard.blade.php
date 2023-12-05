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
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ballance All</span>
                            <span class="info-box-number">
                                <h3>{{ $balanceAll }}</h3>


                            </span>

                            <a href="#" class="small-box-footer">Detail<i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-arrow-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Income All</span>
                            <span class="info-box-number">
                                <h3>{{ $incomeAll }}</h3>

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

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-arrow-down"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Expanse All</span>
                            <span class="info-box-number">
                                <h3>{{ $expenseAll }}</h3>

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

            <!-- Chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="chart-responsive">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="pieChart" height="656" width="1312"
                                        style="display: block; width: 656px; height: 328px;"
                                        class="chartjs-render-monitor"></canvas>
                                </div>

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

            </div>
            <!-- /Chart -->

        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->

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
@endsection

@section('addJavascript')
@endsection

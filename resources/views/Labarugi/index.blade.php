@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laba/Rugi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Laba/Rugi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Laba/Rugi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            @if (Auth::check() && Auth::user()->role_id == '1')
                                                <th>Nama Pengguna</th>
                                            @endif
                                            <th>Pendapatan</th>
                                            <th>Pengeluaran</th>
                                            <th>Bulan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($labarugiData as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                @if (Auth::check() && Auth::user()->role_id == '1')
                                                    <td>
                                                        @if ($data->user)
                                                            {{ $data->user->name }}
                                                        @else
                                                            Pengguna tidak ditemukan
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ 'Rp. ' . number_format($data->pendapatan, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp. ' . number_format($data->pengeluaran, 2, ',', '.') }}</td>
                                                <td>{{ $data->bulan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection

@section('addJavascript')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Script tambahan inisialisasi datatables --}}
    <script>
        $(function() {
            $("#data-table").DataTable();
        })
    </script>
@endsection

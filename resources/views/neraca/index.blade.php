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
                    <h1 class="m-0 text-dark">Neraca</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Neraca</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List Data Neraca Bulanan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            @if (Auth::check() && Auth::user()->role_id == '1')
                                                <th>Nama Pengguna</th>
                                            @endif
                                            <th>Aset</th>
                                            <th>Kewajiban</th>
                                            <th>Ekuitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($neracas as $neraca)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                @if (Auth::check() && Auth::user()->role_id == '1')
                                                    <td>
                                                        @if ($neraca->user)
                                                            {{ $neraca->user->name }}
                                                        @else
                                                            Pengguna tidak ditemukan
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ 'Rp. ' . number_format($neraca->aset, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp. ' . number_format($neraca->kewajiban, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp. ' . number_format($neraca->ekuitas, 2, ',', '.') }}</td>
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

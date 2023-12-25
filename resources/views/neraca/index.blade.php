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
                                            <th>No</th>
                                            @if (Auth::check() && Auth::user()->role_id == '1')
                                                <th>Nama Pengguna</th>
                                            @endif
                                            <th>Aset</th>
                                            <th>Kewajiban</th>
                                            <th>Ekuitas</th>
                                            <th>Bulan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                @if (Auth::check() && Auth::user()->role_id == '1')
                                                    <td>{{ $row->name }}</td>
                                                @endif
                                                <td>{{ 'Rp. ' . number_format($row->aset, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp. ' . number_format($row->kewajiban, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp. ' . number_format($row->ekuitas, 2, ',', '.') }}</td>
                                                <td>{{ $row->bulan }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $row->id }}_{{ str_replace(' ', '', $row->bulan) }}"><i
                                                            class='fas fa-info-circle'></i> Detail</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="exampleModal{{ $row->id }}_{{ str_replace(' ', '', $row->bulan) }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Detail
                                                                        Data
                                                                        Perubahan Modal</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="gg" style="width: 100%">
                                                                        <tr>
                                                                            <td class="navy">ID Pengguna </td>
                                                                            <td>{{ $row->id }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Nama Pengguna </td>
                                                                            <td>{{ $row->name }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Aset </td>
                                                                            <td>{{ 'Rp. ' . number_format($row->aset, 2, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Kewajiban
                                                                            </td>
                                                                            <td>{{ 'Rp. ' . number_format($row->kewajiban, 2, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Ekuitas
                                                                            </td>
                                                                            <td>{{ 'Rp. ' . number_format($row->ekuitas, 2, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Bulan </td>
                                                                            <td>{{ $row->bulan }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"> <i
                                                                            class="fa fa-arrow-left"></i>
                                                                        Kembali</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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

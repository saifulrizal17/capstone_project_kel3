@extends('layouts.master')

@section('addCss')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Perubahan Modals</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ auth()->user()->role == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
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
            <div class="card-header text-right">
                <a href="{{ route('createPerubahanModal') }}" class="btn btn-primary" role="button">Tambah Data</a>
            </div>

            <div class="card">
                <div class="card-body ">
                    <table class="table table-hover mb-0 table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th>ID User</th>
                                <th>Nama</th>
                                <th>Tanggal Perubahan</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perubahanModals as $perubahanModal)
                                <tr>
                                    <td>{{ $perubahanModal->id }}</td>
                                    <td>{{ $perubahanModal->id_user }}</td>
                                    <td>
                                        @if ($perubahanModal->user)
                                            {{ $perubahanModal->user->name }}
                                        @else
                                            Pengguna tidak ditemukan
                                        @endif
                                    </td>
                                    <td>{{ $perubahanModal->tanggal_perubahan }}</td>
                                    <td>{{ $perubahanModal->keterangan }}</td>
                                    <td>{{ $perubahanModal->jumlah }}</td>
                                    <td>
                                        <a href="{{ route('editPerubahanModal', $perubahanModal->id) }}"
                                            class="btn btn-warning btn-sm" role="button">Edit</a>

                                        <a href="{{ route('deletePerubahanModal', $perubahanModal->id) }}"
                                            class="btn btn-danger btn-sm" role="button">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
@endsection

@section('addJavascript')
@endsection

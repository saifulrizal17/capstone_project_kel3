@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Aruskas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Arus Kas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            {{-- main content here --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Catatan Keuangan</h3>
                    <div class="card-tools">
                        <a href="{{ route('createAruskas') }}" class="btn btn-primary">Tambah Catatan</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catatanKeuangans as $catatanKeuangan)
                                <tr>
                                    <td>{{ $catatanKeuangan->id }}</td>
                                    <td>{{ $catatanKeuangan->tanggal_transaksi }}</td>
                                    <td>{{ $catatanKeuangan->jumlah }}</td>
                                    <td>{{ $catatanKeuangan->keterangan }}</td>
                                    <td>{{ $catatanKeuangan->jenis }}</td>
                                    <td>{{ $catatanKeuangan->kategori }}</td>
                                    <td>
                                        <a href="{{ route('editAruskas', $catatanKeuangan->id) }}" method=""
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('deleteAruskas', $catatanKeuangan->id) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Modals</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Modals</li>
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
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('perubahanmodal.store') }}"method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tanggal_perubahan">Tanggal Perubahan</label>
                                        <input type="date" name="tanggal_perubahan" id="tanggal_perubahan"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control" required
                                            placeholder="Masukkan keterangan"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" name="jumlah" id="jumlah" class="form-control" required
                                            placeholder="Masukkan jumlah">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-secondary" href="{{ route('perubahanmodal.index') }}">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Apakah Anda yakin ingin menambahkan data ini?');">
                                        <i class="fas fa-plus"></i>
                                        Tambah
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Arus Kas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-primary"><a href="{{ route('aruskas.index') }}">Data
                                Arus Kas</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Data Arus Kas</li>
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
                            <form action="{{ route('aruskas.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id_jenis">Jenis Catatan</label>
                                        <select class="form-control" name="id_jenis" id="id_jenis" required="required">
                                            @foreach ($jeniss as $jenis)
                                                <option value="{{ $jenis->id }}" data-cat-id="{{ $jenis->jenis_id }}">
                                                    {{ $jenis->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_kategori">Jenis Kategori</label>
                                        <select class="form-control" name="id_kategori" id="id_kategori"
                                            required="required">
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    data-cat-id="{{ $kategori->jenis_id }}">
                                                    {{ $kategori->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                        <input type="date" name="tanggal_transaksi" class="form-control" required>
                                        @error('tanggal_transaksi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control" required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a class="btn btn-secondary" href="{{ route('aruskas.index') }}">
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
        </div>
    </div>
    <!-- /.content -->
@endsection

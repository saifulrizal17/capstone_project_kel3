@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary"><a href="{{ route('admin.kategori.index') }}">Data
                                Kategori</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Data Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-navy">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-plus"></i> Update Data
                            </h3>
                        </div>
                        <form action="{{ route('admin.kategori.update', ['id' => $kategori->id]) }}" method="post"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jenis_id">Nama Jurusan</label>
                                    <select class="form-control" name="jenis_id" id="jenis_id" required="required">
                                        @foreach ($jeniss as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ $jenis->id == $kategori->jenis_id ? 'selected' : '' }}>
                                                {{ $jenis->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Pelajaran</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        required="required" value="{{ $kategori->name }}"
                                        placeholder="Masukkan name kategori">
                                </div>

                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" required="required"
                                        placeholder="Masukkan deskripsi kategori">{{ $kategori->description }}</textarea>
                                </div>

                                <div class="card-footer">
                                    <a class="btn btn-secondary" href="{{ route('admin.kategori.index') }}">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?');">
                                        <i class="fas fa-save"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

    <div class="content">
        <div class="container-fluid">

            {{-- main content here --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Perubahan Modal</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('perubahanmodal.store') }}"method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="card-body">
                            @if (Auth::check() && Auth::user()->role_id == '1')
                                <div class="form-group">
                                    <label for="id_user">Nama User</label>
                                    <select class="form-control" name="id_user" id="id_user" required="required">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="id_jenis">Jenis Catatan</label>
                                <select class="form-control" name="id_jenis" id="id_jenis" required="required">
                                    <option value="">-- Pilih Jenis Perubahan Modal --</option>
                                    @foreach ($jeniss as $jenis)
                                        <option value="{{ $jenis->id }}">
                                            {{ $jenis->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_perubahan">Tanggal Perubahan</label>
                                <input type="date" name="tanggal_perubahan" id="tanggal_perubahan" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="jumlah" class="form-control" required>
                                </div>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" required
                                    placeholder="Masukkan keterangan"></textarea>
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
    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection

@section('addJavascript')
    <script>
        document.getElementById('tanggal_perubahan').valueAsDate = new Date();
    </script>
@endsection

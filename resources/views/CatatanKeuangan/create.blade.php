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
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Catatan Keuangan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('aruskas.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="card-body">
                            @if (Auth::check() && Auth::user()->role_id == '1')
                                <div class="form-group">
                                    <label for="id_user">Nama User</label>
                                    <select class="form-control" name="id_user" id="id_user" required="required">
                                        <option value="">-- Pilih Jenis User --</option>
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
                                <select class="form-control" name="id_jenis" id="id_jenis" required="required"
                                    onchange="updateKategoriOptions()">
                                    <option value="">-- Pilih Jenis Catatan --</option>
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
                                <label for="id_kategori">Jenis Kategori</label>
                                <select class="form-control" name="id_kategori" id="id_kategori" required="required">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" data-jenisid="{{ $kategori->id_jenis }}">
                                            {{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                                    required>
                                @error('tanggal_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
    <!-- /.content -->
@endsection

@section('addJavascript')
    <script>
        document.getElementById('tanggal_transaksi').valueAsDate = new Date();

        function updateKategoriOptions() {
            var selectedJenisId = document.getElementById('id_jenis').value;
            var kategoriDropdown = document.getElementById('id_kategori');

            // Reset options
            kategoriDropdown.innerHTML = '';

            // Add options based on selected id_jenis
            if (selectedJenisId !== "") {
                @foreach ($kategoris as $kategori)
                    if (selectedJenisId == 1 && {{ $kategori->id_jenis }} == 1) {
                        var option = document.createElement('option');
                        option.value = "{{ $kategori->id }}";
                        option.text = "{{ $kategori->name }}";
                        kategoriDropdown.add(option);
                    } else if (selectedJenisId == 2 && {{ $kategori->id_jenis }} == 2) {
                        var option = document.createElement('option');
                        option.value = "{{ $kategori->id }}";
                        option.text = "{{ $kategori->name }}";
                        kategoriDropdown.add(option);
                    }
                @endforeach
            } else {
                // If no jenis is selected, display a placeholder in the kategoriDropdown
                var placeholderOption = document.createElement('option');
                placeholderOption.value = "";
                placeholderOption.text = "Pilih Jenis Catatan Terlebih Dahulu";
                kategoriDropdown.add(placeholderOption);
            }
        }

        // Initial call to populate kategori options based on default selected id_jenis
        updateKategoriOptions();
    </script>
@endsection

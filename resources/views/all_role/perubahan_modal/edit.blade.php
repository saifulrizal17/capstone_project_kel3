@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Perubahan Modal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Perubahan Modal</li>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Perubahan Modal</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('perubahanmodal.update', $perubahanModal->id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="card-body">
                            @if (Auth::check() && Auth::user()->role_id == '1')
                                <div class="form-group">
                                    <label for="id_user">Nama User</label>
                                    <select class="form-control" name="id_user" id="id_user" required="required">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($user->role_id != '1') {{ $user->id == $perubahanModal->id_user ? 'selected' : '' }}>
                                                {{ $user->name }}</option> @endif
                                                @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="id_jenis">Nama Jurusan</label>
                                <select class="form-control" name="id_jenis" id="id_jenis" required="required">
                                    @foreach ($jeniss as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ $jenis->id == $perubahanModal->id_jenis ? 'selected' : '' }}>
                                            {{ $jenis->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_perubahan">Tanggal Perubahan</label>
                                <input type="date" name="tanggal_perubahan" id="tanggal_perubahan" class="form-control"
                                    required value="{{ $perubahanModal->getTanggalPerubahanFormattedForInput() }}">
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" name="jumlah" id="jumlah" class="form-control currency"
                                        required value="{{ $perubahanModal->jumlah }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">,00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" required
                                    placeholder="Masukkan keterangan">{{ $perubahanModal->keterangan }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('perubahanmodal.index') }}">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?');">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
    <!-- /.content -->
@endsection

@section('addJavascript')
    <!-- Cleave.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cleaveC = new Cleave('.currency', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    </script>
@endsection

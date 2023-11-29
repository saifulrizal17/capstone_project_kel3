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
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Perubahan Modal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('updatePerubahanModal', $perubahanModal->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_user">ID</label>
                            <input type="text" name="id_user" id="id_user" class="form-control" required
                                value="{{ $perubahanModal->id }}">
                        </div>
                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" name="id_user" id="id_user" class="form-control" required
                                value="{{ $perubahanModal->id_user }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_perubahan">Tanggal Perubahan</label>
                            <input type="date" name="tanggal_perubahan" id="tanggal_perubahan" class="form-control"
                                required value="{{ $perubahanModal->tanggal_perubahan }}">
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control" required
                                placeholder="Masukkan keterangan">{{ $perubahanModal->keterangan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" name="jumlah" id="jumlah" class="form-control" required
                                value="{{ $perubahanModal->jumlah }}">
                        </div>

                        <div class="text-right">
                            <a href="{{ route('perubahanModal') }}" class="btn btn-outline-secondary mr-2"
                                role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->

    <!-- /.content -->
@endsection

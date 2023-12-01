@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Starter</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Starter</li>
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
                <h3 class="card-title">Edit Catatan Keuangan</h3>
            </div>
            <div class="card-body">
               <form action="{{ route('updateAruskas', $catatanKeuangan->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                        <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $catatanKeuangan->tanggal_transaksi }}">
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="text" name="jumlah" class="form-control" value="{{ $catatanKeuangan->jumlah }}">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" class="form-control">{{ $catatanKeuangan->keterangan }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>


	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
@endsection


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

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Catatan Keuangan</h3>
                            <div class="card-tools">
                                <a href="{{ route('aruskas.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-plus"></i>Tambah Catatan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Filter -->
                            <div class="text-center mb-3">
                                <h5>Filter Data</h5>
                            </div>
                            <form action="{{ route('aruskas.filter') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-center flex-wrap border-bottom pb-3">
                                    <div class="form-group
                                    mr-2 mb-2">
                                        <select class="form-control equal-width" name="jenis" id="jenis">
                                            <option value="">Pilih Jenis Catatan</option>
                                            @foreach ($jeniss as $jenis)
                                                <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <input type="date" class="form-control equal-width" id="start_date"
                                            name="start_date" title="Tanggal Awal">
                                    </div>

                                    <div class="form-group mr-2 mb-2">
                                        <input type="date" class="form-control equal-width" id="end_date"
                                            name="end_date" title="Tanggal Akhir">
                                    </div>

                                    <div class="form-group mr-2 mb-2">
                                        <button type="submit" class="btn btn-outline-dark"><i class="fas fa-filter"></i>
                                            Filter</button>
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <a href="{{ route('aruskas.exportPDF') }}" target="_blank"
                                            class="btn btn-outline-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
                                    </div>
                                    <div class="form-group mr-2 mb-2">
                                        <a href="{{ route('aruskas.exportExcel') }}" class="btn btn-outline-primary"><i
                                                class="fas fa-file-excel"></i> Export Excel</a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            @if (Auth::check() && Auth::user()->role_id == '1')
                                                <th>Nama Pengguna</th>
                                            @endif
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($catatanKeuangans as $catatanKeuangan)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                @if (Auth::check() && Auth::user()->role_id == '1')
                                                    <td>
                                                        @if ($catatanKeuangan->user)
                                                            {{ $catatanKeuangan->user->name }}
                                                        @else
                                                            Pengguna tidak ditemukan
                                                        @endif
                                                    </td>
                                                @endif
                                                <td> {{ $catatanKeuangan->jenis->name }}
                                                </td>
                                                <td>
                                                    @if ($catatanKeuangan->kategori)
                                                        {{ $catatanKeuangan->kategori->name }}
                                                    @else
                                                        Kategori tidak ditemukan
                                                    @endif
                                                </td>
                                                <td>{{ $catatanKeuangan->tanggal_transaksi }}</td>
                                                <td>{{ 'Rp. ' . number_format($catatanKeuangan->jumlah, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('aruskas.edit', $catatanKeuangan->id) }}"
                                                        class="btn btn-info btn-sm"><i class='fas fa-edit'></i> Edit</a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $catatanKeuangan->id }}"><i
                                                            class='fas fa-info-circle'></i>
                                                        Detail</a>
                                                    {{-- <a href="{{ route('aruskas.delete', $catatanKeuangan->id) }}"
                                                        class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i>
                                                        Hapus</a> --}}
                                                    <a href="#" class="btn btn-danger btn-sm btn-delete"
                                                        data-keuangan-id="{{ $catatanKeuangan->id }}">
                                                        <i class='fas fa-trash-alt'></i> Hapus
                                                    </a>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $catatanKeuangan->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                        Data
                                                                        Catatan Keuangan</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="gg" style="width: 100%">
                                                                        <tr>
                                                                            <td class="navy">ID Catatan Keuanagan </td>
                                                                            <td>{{ $catatanKeuangan->id }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Nama Pengguna </td>
                                                                            <td>{{ $catatanKeuangan->user->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Jenis Catatan Keuanagan
                                                                            </td>
                                                                            <td>{{ $catatanKeuangan->jenis->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Kategori Catatan Keuangan
                                                                            </td>
                                                                            <td>{{ $catatanKeuangan->kategori->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Tanggal Transaksi</td>
                                                                            <td>{{ $catatanKeuangan->tanggal_transaksi }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Jumlah </td>
                                                                            <td>{{ 'Rp. ' . number_format($catatanKeuangan->jumlah, 2, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Keterangan </td>
                                                                            <td>{{ $catatanKeuangan->keterangan }}</td>
                                                                        </tr>

                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"> <i
                                                                            class="fa fa-arrow-left"></i>
                                                                        Kembali</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('addJavascript')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Script tambahan inisialisasi datatables --}}
    <script>
        $(function() {
            $("#data-table").DataTable();
        })
    </script>
    <script>
        // GLOBAL SETUP 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            // Hapus Data
            $('#data-table').on('click', '.btn-delete', function() {
                var id = $(this).data('keuangan-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "",
                            text: "Menghapus Data",
                            imageUrl: "https://c.tenor.com/I6kN-6X7nhAAAAAj/Loading-buffering.gif",
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(() => {
                            $.ajax({
                                type: 'DELETE',
                                url: '/aruskas/ajax/' + id,
                                dataType: 'json',
                                success: function(data) {
                                    console.log('Success:', data);
                                    location.reload();

                                    Swal.fire({
                                        title: 'Sukses!',
                                        text: data.message,
                                        icon: 'success',
                                        allowOutsideClick: false,
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                    });
                                },
                                error: function(error) {
                                    console.error('Error:', error);
                                    Swal.fire('Error!',
                                        'Terjadi kesalahan saat menghapus data',
                                        'error');
                                },
                            });
                        });
                    }
                });
            });
        });
    </script>
@endsection

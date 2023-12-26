@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
@endsection


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Data Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Alert Sukses -->
            @if (session('success'))
                <div class="alert alert-success" style="display: none">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                List Data Kategori
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-plus"></i> Tambah
                                    Kategori</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr class="text-center bg-primary">
                                            <th>No</th>
                                            <th>Jenis</th>
                                            <th>Nama Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($kategoris as $kategori)
                                            <tr class="text-center">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $kategori->jenis->name ?? 'Tidak Tersedia' }}
                                                </td>
                                                <td>{{ $kategori->name }}</td>
                                                <td>{{ $kategori->description }}</td>
                                                <td>
                                                    <a href="{{ route('admin.kategori.edit', ['kategori' => $kategori->id]) }}"
                                                        class="btn btn-info btn-sm"><i class='fas fa-edit'></i> Edit</a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $kategori->id }}"><i
                                                            class='fas fa-info-circle'></i>
                                                        Detail</a>
                                                    <a href="#" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="{{ $kategori->id }}">
                                                        <i class='fas fa-trash-alt'></i> Hapus
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $kategori->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                        Data
                                                                        Kategori: {{ $kategori->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="gg" style="width: 100%">
                                                                        <tr>
                                                                            <td class="navy">ID Kategori</td>
                                                                            <td>{{ $kategori->id }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Jenis </td>
                                                                            <td>{{ $kategori->jenis->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy"> Nama Kategori</td>
                                                                            <td>{{ $kategori->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Deskripsi</td>
                                                                            <td>{{ $kategori->description }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"> <i
                                                                            class="fa fa-arrow-left"></i> Kembali</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJavascript')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                var id = $(this).data('id');

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
                                url: '/kategori/ajax/' + id,
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

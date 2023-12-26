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
                    <h1 class="m-0 text-dark">Perubahan Modal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Perubahan Modals</li>
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
                    <h3 class="card-title">List Data Perubahan Modal</h3>
                    <div class="card-tools">
                        <a href="{{ route('perubahanmodal.create') }}" class="btn btn-primary btn-sm"><i
                                class="fas fa-plus"></i>Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    @if (Auth::check() && Auth::user()->role_id == '1')
                                        <th>Nama Pengguna</th>
                                    @endif
                                    <th>Jenis</th>
                                    <th>Tanggal Perubahan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @foreach ($perubahanModals as $perubahanModal)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        @if (Auth::check() && Auth::user()->role_id == '1')
                                            <td>
                                                @if ($perubahanModal->user)
                                                    {{ $perubahanModal->user->name }}
                                                @else
                                                    Pengguna tidak ditemukan
                                                @endif
                                            </td>
                                        @endif
                                        <td> {{ $perubahanModal->jenis->name }}
                                        <td>{{ $perubahanModal->tanggal_perubahan }}</td>
                                        <td>{{ 'Rp. ' . number_format($perubahanModal->jumlah, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('perubahanmodal.edit', $perubahanModal->id) }}"
                                                class="btn btn-info btn-sm"><i class='fas fa-edit'></i> Edit</a>
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#exampleModal{{ $perubahanModal->id }}"><i
                                                    class='fas fa-info-circle'></i>
                                                Detail</a>
                                            {{-- <a href="{{ route('perubahanmodal.delete', $perubahanModal->id) }}"
                                                class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i>
                                                Hapus</a> --}}
                                            <a href="#" class="btn btn-danger btn-sm btn-delete"
                                                data-modal-id="{{ $perubahanModal->id }}">
                                                <i class='fas fa-trash-alt'></i> Hapus
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $perubahanModal->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                Data
                                                                Perubahan Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="gg" style="width: 100%">
                                                                <tr>
                                                                    <td class="navy">ID Catatan Keuanagan </td>
                                                                    <td>{{ $perubahanModal->id }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="navy"> Nama Pengguna </td>
                                                                    <td>{{ $perubahanModal->user->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="navy"> Kategori Perubahan Modal
                                                                    </td>
                                                                    <td>{{ $perubahanModal->jenis->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="navy"> Tanggal Perubahan </td>
                                                                    <td>{{ $perubahanModal->tanggal_perubahan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="navy"> Jumlah </td>
                                                                    <td>{{ 'Rp. ' . number_format($perubahanModal->jumlah, 2, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="navy"> Keterangan </td>
                                                                    <td>{{ $perubahanModal->keterangan }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> <i class="fa fa-arrow-left"></i>
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
        </div>
    </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
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
                var id = $(this).data('modal-id');

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
                                url: '/modals/ajax/' + id,
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

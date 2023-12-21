@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .btn-group .dropdown-menu a {
            color: #007bff;
        }

        .btn-group .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .btn-group .dropdown-menu a:hover,
        .btn-group .dropdown-menu a:focus {
            background-color: #007bff;
            color: #fff;
        }
    </style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Manajemen Users</li>
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
                            <h3 class="card-title">
                                List Data Users
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tambah / Import Users
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.users.create') }}"
                                            class="dropdown-item btn btn-primary btn-sm">
                                            <i class="fas fa-user-plus"></i> Tambah Users
                                        </a>
                                        <a href="#" class="dropdown-item btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#importModal">
                                            <i class="fas fa-file-excel"></i> &nbsp;&nbsp; Import Users
                                        </a>
                                    </div>
                                </div>


                                <!-- Modal for file upload -->
                                <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                                    aria-labelledby="importModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importModalLabel">Import Data Users</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.users.import.excel') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="file">Choose Excel File</label>
                                                        <input type="file" class="form-control-file" id="file"
                                                            name="file" required>
                                                    </div>

                                                    <p>Download template excel: <a
                                                            href="{{ route('admin.users.download.template') }}">Download
                                                            Template</a></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Profile</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <img src="{{ $user->profile_photo ? asset('upload/profile photo/' . $user->profile_photo) : asset('upload/profile photo/profile-default.png') }}"
                                                        alt="Profile Photo" class="img-fluid rounded-circle"
                                                        style="max-width: 100%; max-height: 50px;">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->roles->name }}</td>
                                                <td>
                                                    @if ($user->is_active === 1)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @elseif($user->is_active === 0)
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                                        class="btn btn-info btn-sm"><i class='fas fa-edit'></i> Edit</a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $user->id }}"><i
                                                            class='fas fa-info-circle'></i>
                                                        Detail</a>
                                                    {{-- <a href="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                                        class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i>
                                                        Hapus</a> --}}
                                                    <a href="#" class="btn btn-danger btn-sm btn-delete"
                                                        data-user-id="{{ $user->id }}">
                                                        <i class='fas fa-trash-alt'></i> Hapus
                                                    </a>
                                                    {{-- <a href="{{ route('admin.users.resetPassword', ['id' => $user->id]) }}"
                                                        class="btn btn-secondary btn-sm"><i class='fas fa-key'></i>
                                                        Reset Password</a> --}}
                                                    <a href="#" class="btn btn-secondary btn-sm btn-reset-password"
                                                        data-user-id="{{ $user->id }}"><i class='fas fa-key'></i>
                                                        Reset Password</a>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered  modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                        Data
                                                                        Users: {{ $user->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered"
                                                                        style="width: 100%">
                                                                        <tr>
                                                                            <td rowspan="8"
                                                                                style="text-align: center; vertical-align: middle;">
                                                                                <img src="{{ $user->profile_photo ? asset('upload/profile photo/' . $user->profile_photo) : asset('upload/profile photo/profile-default.png') }}"
                                                                                    alt="Profile Photo"
                                                                                    class="img-fluid rounded-circle"
                                                                                    style="max-width: 100%; max-height: 300px; display: inline-block;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nama Lengkap</td>
                                                                            <td>{{ $user->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td>{{ $user->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>No HP</td>
                                                                            <td>{{ $user->phone_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pekerjaan</td>
                                                                            <td>{{ $user->job_title }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Alamat</td>
                                                                            <td>{{ $user->address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Role</td>
                                                                            <td>{{ $user->roles->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Status Akun</td>
                                                                            <td>
                                                                                @if ($user->is_active == 1)
                                                                                    Aktif
                                                                                @elseif($user->is_active == 0)
                                                                                    Non Aktif
                                                                                @else
                                                                                    Akun tidak valid
                                                                                @endif
                                                                            </td>
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
                    </div><!-- /.container-fluid -->
                </div>
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
                var id = $(this).data('user-id');

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
                                url: '/users/ajax/' + id,
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

            // Reset Password
            $('#data-table').on('click', '.btn-reset-password', function() {
                var id = $(this).data('user-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Password pengguna akan direset ke nilai default (12345678)',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, reset password!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "",
                            text: "Merestet Password",
                            imageUrl: "https://c.tenor.com/I6kN-6X7nhAAAAAj/Loading-buffering.gif",
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(() => {
                            // Perform the password reset action
                            $.ajax({
                                type: 'GET',
                                url: '/users/reset-password/' + id,
                                dataType: 'json',
                                success: function(data) {
                                    console.log('Success:', data);

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
                                        'Terjadi kesalahan saat mereset password',
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

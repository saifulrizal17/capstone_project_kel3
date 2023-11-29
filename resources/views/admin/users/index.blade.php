@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .navy {
            width: 150px;
            background-color: #007bff;
            color: white;
        }
    </style>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Data Users</li>
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
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-user-plus"></i> Tambah
                                    Users</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID User</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID User</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                {{-- <td>{{ $user->id }}</td> --}}
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>
                                                    @if ($user->role_id === 1)
                                                        Admin
                                                    @elseif($user->role_id === 2)
                                                        User
                                                    @endif
                                                </td>
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
                                                    <a href="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                                        class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i>
                                                        Hapus</a>
                                                    {{-- <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class='fas fa-trash-alt'></i> Hapus
                                                        </button>
                                                    </form> --}}
                                                    <a href="{{ route('admin.users.resetPassword', ['id' => $user->id]) }}"
                                                        class="btn btn-secondary btn-sm"><i class='fas fa-key'></i>
                                                        Reset Password</a>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $user->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                                    <table class="gg" style="width: 100%">

                                                                        <tr>
                                                                            <td class="navy">Id Users</td>
                                                                            <td>{{ $user->id }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Nama Lengkap</td>
                                                                            <td>{{ $user->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Email</td>
                                                                            <td>{{ $user->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">No HP</td>
                                                                            <td>{{ $user->phone_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Pekerjaan</td>
                                                                            <td>{{ $user->job_title }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Alamat</td>
                                                                            <td>{{ $user->address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Role</td>
                                                                            <td>
                                                                                @if ($user->role_id == 1)
                                                                                    Admin
                                                                                @elseif($user->role_id == 2)
                                                                                    User
                                                                                @else
                                                                                    Role tidak valid
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="navy">Akun (Aktif/Non Aktif)</td>
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
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Script tambahan inisialisasi datatables --}}
    <script>
        $(function() {
            $("#data-table").DataTable();
        })
    </script>
@endsection

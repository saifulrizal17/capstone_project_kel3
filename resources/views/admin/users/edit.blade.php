@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary"><a href="{{ route('admin.users.index') }}">Data
                                Users</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Data Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-edit"></i> Edit Data Users
                            </h3>
                        </div>
                        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Full name"
                                            name="name" value="{{ $user->name }}" required autocomplete="name"
                                            autofocus>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $user->email }}" placeholder="Email" required autocomplete="email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ $user->phone_number }}" placeholder="Nomor HP"
                                            required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input id="job_title" type="text"
                                            class="form-control @error('job_title') is-invalid @enderror" name="job_title"
                                            value="{{ $user->job_title }}" placeholder="Pekerjaan" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                        </div>
                                        @error('job_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Alamat"
                                            required>{{ $user->address }}</textarea>
                                        <div class="input-group-append">
                                            <div class="input-group-append input-group-text">
                                                <span class="fa fa-map"></span>
                                            </div>
                                        </div>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <select id="role_id" name="role"
                                                    class="form-control @error('role_id') is-invalid @enderror" required>
                                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User
                                                    </option>
                                                    {{-- <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>
                                                        Admin
                                                    </option> --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <select id="is_active" name="is_active"
                                                    class="form-control @error('is_active') is-invalid @enderror">
                                                    <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>
                                                        Non Aktif
                                                    </option>
                                                    <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>
                                                        Aktif
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" name="password" autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    placeholder="Ulangi password" name="password_confirmation"
                                                    autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?');">
                                    <i class="fa fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
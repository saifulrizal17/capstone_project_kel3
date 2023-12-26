@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary"><a href="{{ route('admin.users.index') }}">Manajemen
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
                                <i class="fas fa-user-plus"></i> Tambah Data Users
                            </h3>
                        </div>
                        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="profile_photo">Foto Profile</label>
                                            <div class="col-sm-10">
                                                <input id="profile_photo" type="file"
                                                    class="form-control-file @error('profile_photo') is-invalid @enderror"
                                                    name="profile_photo" accept="image/*">
                                                @error('profile_photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <br>
                                                <img id="preview"
                                                    src="{{ asset('/upload/profile photo/profile-default.png') }}"
                                                    class="img-fluid rounded-circle" alt="Preview"
                                                    style="max-width: 100%; max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <div class="input-group mb-3">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"
                                                    required autocomplete="name" autofocus>
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
                                            <label for="email">Email</label>
                                            <div class="input-group mb-3">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" placeholder="Email" required
                                                    autocomplete="email">
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
                                            <label for="phone_number">No HP</label>
                                            <div class="input-group mb-3">
                                                <input id="phone_number" type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    name="phone_number" value="{{ old('phone_number') }}"
                                                    placeholder="Nomor HP" required>
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
                                            <label for="job_title">Pekerjaan</label>
                                            <div class="input-group mb-3">
                                                <input id="job_title" type="text"
                                                    class="form-control @error('job_title') is-invalid @enderror"
                                                    name="job_title" value="{{ old('job_title') }}" placeholder="Pekerjaan"
                                                    required>
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
                                            <label for="address">Alamat</label>
                                            <div class="input-group mb-3">
                                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                                                    placeholder="Alamat" required>{{ old('address') }}</textarea>
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
                                                <label for="password">Password</label>
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            placeholder="Password" name="password"
                                                            autocomplete="new-password">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password-confirm">Ulangi Password</label>
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
                                            onclick="return confirm('Apakah Anda yakin ingin menambahkan data ini?');">
                                            <i class="fas fa-plus"></i>
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJavascript')
    <script>
        document.getElementById('profile_photo').addEventListener('change', function() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('profile_photo');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

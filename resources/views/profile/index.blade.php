@extends('layouts.master')

@section('addCss')
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">My Profile </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-primary"><a
                                href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">My Profile </li>
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
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (Auth::user()->profile_photo)
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('/upload/profile photo/' . $user->profile_photo) }}"
                                        alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('/upload/profile photo/profile-default.png') }}"
                                        alt="User profile picture">
                                @endif
                            </div>



                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Balance All</b> <a class="float-right">Rp. {{ number_format($balance, 2) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Income All</b> <a class="float-right">Rp. {{ number_format($income, 2) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Expense All</b> <a class="float-right">Rp. {{ number_format($expense, 2) }}</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <!-- About Me Box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-briefcase mr-1"></i> Pekerjaan</strong>

                            <p class="text-muted">{{ Auth::user()->job_title }}</p>

                            <hr>

                            <strong><i class="fas fa-map mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ Auth::user()->address }}</p>

                            <hr>

                            <strong><i class="fas fa-phone mr-1"></i> No HP</strong>

                            <p class="text-muted">{{ Auth::user()->phone_number }}</p>

                            <hr>

                            <strong><i class="far fa-envelope mr-1"></i> Email</strong>

                            <p class="text-muted">{{ Auth::user()->email }}</p>

                        </div>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                Setting
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item"><a class="nav-link btn-sm active" href="#history"
                                            data-toggle="tab">History</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#password"
                                            data-toggle="tab">Password</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link btn-sm " href="#about_me"
                                            data-toggle="tab">About
                                            Me</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                {{-- History --}}
                                <div class="active tab-pane" id="history">
                                    <div class="timeline timeline-inverse">
                                        @foreach ($financialHistory as $transaction)
                                            <div class="time-label">
                                                <span class="bg-gray">{{ $transaction->tanggal_transaksi }}</span>
                                            </div>
                                            <div>
                                                <i
                                                    class="fas fa-user bg-{{ $transaction->id_jenis == 1 ? 'primary' : 'danger' }}"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i>
                                                        {{ $transaction->created_at->format('H:i') }}</span>
                                                    <h3 class="timeline-header border-0">
                                                        @if (Auth::check() && Auth::user()->role_id == '1')
                                                            <a href="{{ route('aruskas.index') }}"
                                                                style="color: {{ $transaction->jenis->id == 1 ? 'blue' : ($transaction->jenis->id == 2 ? 'red' : 'black') }}"><span
                                                                    style="color: black">{{ $transaction->user->name }}</span>
                                                                {{ $transaction->jenis->name }}</a>
                                                        @endif
                                                        @if (Auth::check() && Auth::user()->role_id == '2')
                                                            <a href="{{ route('aruskas.index') }}"
                                                                style="color: {{ $transaction->jenis->id == 1 ? 'blue' : ($transaction->jenis->id == 2 ? 'red' : 'black') }}">
                                                                {{ $transaction->jenis->name }}
                                                            </a>
                                                        @endif

                                                        {{ $transaction->keterangan }}
                                                        Rp. {{ number_format($transaction->jumlah) }}
                                                    </h3>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Password  --}}
                                <div class="tab-pane" id="password">
                                    <form class="form-horizontal"
                                        action="{{ route('profile.update.password', ['user' => $user->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" name="password" autocomplete="new-password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPasswordConfirm" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    placeholder="Confirm password" name="password_confirmation"
                                                    autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- About Me --}}
                                <div class="tab-pane" id="about_me">
                                    <form class="form-horizontal"
                                        action="{{ route('profile.update.aboutme', ['user' => $user->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Full name" name="name" value="{{ $user->name }}"
                                                    required autocomplete="name" autofocus>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $user->email }}" placeholder="Email"
                                                    required autocomplete="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputNoHP" class="col-sm-2 col-form-label">No HP</label>
                                            <div class="col-sm-10">
                                                <input id="phone_number" type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    name="phone_number" value="{{ $user->phone_number }}"
                                                    placeholder="Nomor HP" required>
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-10">
                                                <input id="job_title" type="text"
                                                    class="form-control @error('job_title') is-invalid @enderror"
                                                    name="job_title" value="{{ $user->job_title }}"
                                                    placeholder="Pekerjaan" required>
                                                @error('job_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                                                    placeholder="Alamat" required>{{ $user->address }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="inputProfilePhoto" class="col-sm-2 col-form-label">Foto
                                                Profile</label>
                                            <div class="col-sm-10">
                                                <input id="profile_photo" type="file"
                                                    class="form-control-file @error('profile_photo') is-invalid @enderror"
                                                    name="profile_photo" accept="image/*">
                                                @error('profile_photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <br>
                                                <img id="preview"
                                                    src="{{ Auth::user()->profile_photo ? asset('/upload/profile photo/' . Auth::user()->profile_photo) : asset('/upload/profile photo/profile-default.png') }}"
                                                    class="img-fluid rounded-circle" alt="Preview"
                                                    style="max-width: 100%; max-height: 200px;">
                                                <br>
                                                @if (Auth::user()->profile_photo)
                                                    <a href="{{ route('user.deleteProfilePhoto') }}">
                                                        Hapus Foto Profile Menjadi Foto Profile Default</a>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
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

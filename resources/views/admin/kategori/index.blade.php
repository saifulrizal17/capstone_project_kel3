@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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
                                        <tr>
                                            <th>ID </th>
                                            <th>Jenis</th>
                                            <th>Nama Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body"></tbody>
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
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // GLOBAL SETUP 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            Swal.fire({
                title: "",
                text: "Memuat Data",
                imageUrl: "https://c.tenor.com/I6kN-6X7nhAAAAAj/Loading-buffering.gif",
                showConfirmButton: false,
                timer: 50,
            }).then(() => {
                // Read Data
                $.ajax({
                    url: '{{ route('admin.kategori.ajaxIndex') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.hasOwnProperty('data')) {
                            var data = response.data;

                            if (data.length === 0) {
                                $('#table-body').html(
                                    '<tr><td colspan="5" class="text-center">Data Kategori Kosong</td></tr>'
                                );
                            } else {
                                $('#table-body').empty();

                                $.each(data, function(index, item) {
                                    var row = '<tr>' +
                                        '<td>' + item.id + '</td>' +
                                        '<td>' + item.jenis.name + '</td>' +
                                        '<td>' + item.name + '</td>' +
                                        '<td>' + item.description + '</td>' +
                                        '<td>' + item.action + '</td>' +
                                        '</tr>';
                                    $('#table-body').append(row);
                                });

                                $('#data-table').DataTable();

                            }

                            Swal.close();
                        } else {
                            console.error('Invalid response format. Missing "data" key.');
                            Swal.fire('Error!',
                                'Format respon tidak valid. Kunci "data" hilang.', 'error');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Terjadi kesalahan saat mengambil data', 'error');
                    }
                });
            });

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

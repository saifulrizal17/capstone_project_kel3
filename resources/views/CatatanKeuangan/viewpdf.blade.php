<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catatan Keuangan Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Catatan Keuangan Report</h1>
    <table>
        <tr>
            <th>No</th>
            @if (Auth::check() && Auth::user()->role_id == '1')
                <th>Nama Pengguna</th>
            @endif
            <th>Jenis</th>
            <th>Kategori</th>
            <th>Tanggal Transaksi</th>
            <th>Jumlah</th>
        </tr>

        @php $no = 1 @endphp
        @foreach ($filteredData as $catatanKeuangan)
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
                <td>{{ $catatanKeuangan->jumlah }}</td>
            </tr>
        @endforeach

    </table>
</body>

</html>

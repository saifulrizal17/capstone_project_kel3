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
            margin: 0;
        }

        h1 {
            position: fixed;
            top: 0;
            left: 0%;
            transform: translateX(-0%);
            text-align: center;
            width: 100%;
            margin: 0;
        }


        h2 {
            position: fixed;
            top: 40px;
            left: 0%;
            transform: translateX(-0%);
            text-align: center;
            width: 100%;
            margin: 0;
        }

        p {
            position: fixed;
            top: 80px;
            left: 0%;
            transform: translateX(-0%);
            text-align: center;
            width: 100%;
            margin: 0;
            font-style: italic;
        }

        hr {
            border: 1px solid #ddd;
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
            text-align: center;
        }

        img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }
    </style>

</head>

<body>

    <img src="https://i.ibb.co/qrKCKfT/logo.png" alt="Logo Sejahtera Indonesia">

    <h1>Sejahtera Indonesia</h1>
    <h2>Laporan Keuangan</h2>
    <p>Tanggal Laporan: <?php echo date('d/m/Y'); ?></p>

    <hr>

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
            <th>Keterangan</th>
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
                <td>{{ 'Rp. ' . number_format($catatanKeuangan->jumlah, 2, ',', '.') }}</td>
                <td>{{ $catatanKeuangan->keterangan }}</td>
            </tr>
        @endforeach

    </table>
</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pinjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Data Pinjaman</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Karyawan</th>
                <th>Nama Lengkap</th>
                <th>Besar Pinjaman</th>
                <th>Keterangan</th>
                <th>Status Lunas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinjamans as $pinjaman)
            <tr>
                <td>{{ $pinjaman->tanggal }}</td>
                <td>{{ $pinjaman->kode_karyawan }}</td>
                <td>{{ $pinjaman->karyawan->nama_karyawan }}</td>
                <td>{{ 'Rp ' . number_format($pinjaman->besar_pinjaman, 0, ',', '.') }}</td>
                <td>{{ $pinjaman->keterangan }}</td>
                <td>{{ $pinjaman->status_lunas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggajian</title>
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
    <h1>Data Gaji</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Periode Gaji</th>
                <th>Kode Karyawan</th>
                <th>Nama Lengkap</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggajians as $penggajian)
            <tr>
                <td>{{ $penggajian->tanggal }}</td>
                <td>{{ $penggajian->periode_gaji }}</td>
                <td>{{ $penggajian->kode_karyawan }}</td>
                <td>{{ $penggajian->karyawan->nama_karyawan }}</td>
                <td>{{ 'Rp ' . number_format($penggajian->gaji_bersih, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

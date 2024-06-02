<!DOCTYPE html>
<html>
<head>
    <title>Laporan Lembur</title>
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
    <h1>Data Lembur</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Karyawan</th>
                <th>Nama Lengkap</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lemburs as $lembur)
            <tr>
                <td>{{ $lembur->tanggal }}</td>
                <td>{{ $lembur->kode_karyawan }}</td>
                <td>{{ $lembur->karyawan->nama_karyawan }}</td>
                <td>{{ $lembur->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

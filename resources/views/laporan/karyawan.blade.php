<!DOCTYPE html>
<html>
<head>
    <title>Laporan Karyawan</title>
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
    <h1>Data Karyawan</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Karyawan</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Bagian</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Agama</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->kode_karyawan }}</td>
                <td>{{ $karyawan->nik }}</td>
                <td>{{ $karyawan->nama_karyawan }}</td>
                <td>{{ $karyawan->bagian->nama_bagian }}</td>
                <td>{{ $karyawan->kelamin }}</td>
                <td>{{ $karyawan->alamat }}</td>
                <td>{{ $karyawan->no_hp }}</td>
                <td>{{ $karyawan->tempat_lahir }}, {{ $karyawan->tgl_lahir->format('d-m-Y') }}</td>
                <td>{{ $karyawan->agama }}</td>
                <td>{{ $karyawan->status }}</td>
                <td>{{ $karyawan->tgl_masuk->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

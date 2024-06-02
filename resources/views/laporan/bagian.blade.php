<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bagian</title>
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
    <h1>Data Bagian</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Bagian</th>
                <th>Nama Bagian</th>
                <th>Gaji Pokok</th>
                <th>Uang Transport</th>
                <th>Uang Makan</th>
                <th>Uang Lembur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bagians as $bagian)
            <tr>
                <td>{{ $bagian->kode_bagian }}</td>
                <td>{{ $bagian->nama_bagian }}</td>
                <td>{{ 'Rp ' . number_format($bagian->gaji_pokok, 0, ',', '.') }}</td>
                <td>{{ 'Rp ' . number_format($bagian->uang_transport, 0, ',', '.') }}</td>
                <td>{{ 'Rp ' . number_format($bagian->uang_makan, 0, ',', '.') }}</td>
                <td>{{ 'Rp ' . number_format($bagian->uang_lembur, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            padding-top: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .gaji-details {
            margin-bottom: 20px;
        }
        .details p, .gaji-details p {
            margin: 0;
            padding: 4px 0;
        }
        .gaji-details {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .gaji-details table, .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .gaji-details th, .gaji-details td {
            text-align: left;
            padding: 8px;
        }
        .total-gaji {
            border-top: 2px solid #333;
            padding-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/jangar.png'))) }}" alt="logo" height="40px"> --}}
    {{-- <img src="{{ $base64 }}" alt="logo" height="40px"> --}}
    <div class="container">
        <h1>Nota Gaji</h1>

        <div class="details">
            <table>
                <tr>
                    <td><p><strong>Tanggal:</strong> {{ $penggajian->tanggal }}</p></td>
                    <td> <p><strong>Periode Gaji:</strong> {{ $penggajian->periode_gaji }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Kode Karyawan:</strong> {{ $penggajian->kode_karyawan }}</p></td>
                    <td><p><strong>Bagian:</strong> {{ $penggajian->karyawan->bagian->nama_bagian }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Nama Karyawan:</strong> {{ $penggajian->karyawan->nama_karyawan }}</p></td>
                </tr>
            </table>
        </div>

        <div class="gaji-details">
            <table>
                <tr>
                    <td>Gaji Pokok:</td>
                    <td>{{ 'Rp ' . number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan Transport:</td>
                    <td>{{ 'Rp ' . number_format($penggajian->tunj_transport, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan Makan:</td>
                    <td>{{ 'Rp ' . number_format($penggajian->tunj_makan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan BPJS Kesehatan:</td>
                    <td>{{ 'Rp ' . number_format($bpjs_kesehatan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan BPJS JKK:</td>
                    <td>{{ 'Rp ' . number_format($bpjs_jkk, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan BPJS JKM:</td>
                    <td>{{ 'Rp ' . number_format($bpjs_jkm, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Lembur:</td>
                    <td>{{ 'Rp ' . number_format($penggajian->total_lembur, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Bonus:</td>
                    <td>{{ 'Rp ' . number_format($penggajian->total_bonus, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Penghasilan Bruto = </strong></td>
                    <td>{{ 'Rp ' . number_format($bruto, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Biaya Jabatan : </td>
                    <td>{{ 'Rp ' . number_format($biaya_jabatan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Iuran BPJS Jaminan Hari Tua (JHT):</td>
                    <td>{{ 'Rp ' . number_format($bpjs_jht, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Iuran BPJS Jaminan Pensiunan (JP):</td>
                    <td>{{ 'Rp ' . number_format($bpjs_jp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Penghasilan Neto = </strong></td>
                    <td>{{ 'Rp ' . number_format($neto, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Penghasilan Neto Setahun = </td>
                    <td>{{ 'Rp ' . number_format($neto * 12, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Penghasilan Tidak Kena Pajak (PTKP):</td>
                    <td>{{ 'Rp ' . number_format($penggajian->ptkp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Penghasilan Kena Pajak (PKP) = </strong></td>
                    <td>{{ 'Rp ' . number_format($pkp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>PPh 21 Setahun:</td>
                    <td>{{ 'Rp ' . number_format($pph21, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>PPh 21 Sebulan = </strong></td>
                    <td>{{ 'Rp ' . number_format($pph21 / 12, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Pinjaman:</td>
                    <td>-{{ 'Rp ' . number_format($penggajian->total_pinjaman, 0, ',', '.') }}</td>
                </tr>

            </table>
        </div>

        <div class="gaji-details total-gaji">
            <table>
                <tr>
                    <td>Gaji Bersih:</td>
                    <td>{{ 'Rp ' . number_format($gaji_bersih, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

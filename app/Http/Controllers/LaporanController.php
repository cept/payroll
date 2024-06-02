<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Bagian;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\Pinjaman;
use App\Models\Penggajian;

class LaporanController extends Controller
{
    //
    public function exportBagian()
    {
        $bagians = Bagian::all();
        $html = view('laporan.bagian', compact('bagians'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('laporan_bagian.pdf');
    }

    public function exportKaryawan()
    {
        $karyawans = Karyawan::all();
        $html = view('laporan.karyawan', compact('karyawans'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('laporan_karyawan.pdf');
    }

    public function exportLembur()
    {
        $lemburs = Lembur::all();
        $html = view('laporan.lembur', compact('lemburs'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('laporan_lembur.pdf');
    }

    public function exportPinjaman()
    {
        $pinjamans = Pinjaman::all();
        $html = view('laporan.pinjaman', compact('pinjamans'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('laporan_pinjaman.pdf');
    }

    public function exportPenggajian(Request $request)
        {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $penggajians = Penggajian::whereBetween('tanggal', [$startDate, $endDate])->get();
            
            foreach ($penggajians as $penggajian) {
                $gaji_total = $penggajian->gaji_pokok + $penggajian->tunj_transport + $penggajian->tunj_makan;
            $bpjs_kesehatan = $gaji_total * $penggajian->karyawan->bagian->bpjs_kesehatan / 100;
            if ($bpjs_kesehatan > 480000) {
                $bpjs_kesehatan = 480000;
            }
            $bpjs_jkk = $gaji_total * $penggajian->karyawan->bagian->bpjs_jkk / 100;
            $bpjs_jkm = $gaji_total * $penggajian->karyawan->bagian->bpjs_jkm / 100;
            $bruto = $gaji_total + $bpjs_kesehatan + $bpjs_jkk + $bpjs_jkm + $penggajian->total_lembur + $penggajian->total_bonus;
            $biaya_jabatan = $bruto * 5 / 100;
            if ($biaya_jabatan > 500000) {
                $biaya_jabatan = 500000;
            }
            $bpjs_jht = $gaji_total * $penggajian->karyawan->bagian->bpjs_jht / 100;
            $bpjs_jp = $gaji_total * $penggajian->karyawan->bagian->bpjs_jp / 100;
            if ($bpjs_jp > 90776) {
                $bpjs_jp = 90776;
            }
            $neto = $bruto - $biaya_jabatan - $bpjs_jht - $bpjs_jp;
            $pkp = $neto * 12 - $penggajian->ptkp;
            if ($pkp <= 60000000) {
                $pph21 = $pkp * 5 / 100;
            } elseif ($pkp <= 250000000) {
                $pkp -= 60000000;
                $pph21 = ($pkp * 15 / 100) + (60000000 * 5 / 100);
            } elseif ($pkp <= 500000000) {
                $pkp -= 60000000 + 250000000;
                $pph21 = ($pkp * 25 / 100) + (250000000 * 15 / 100) + (60000000 * 5 / 100);
            } elseif ($pkp <= 5000000000) {
                $pkp -= 60000000 + 250000000 + 500000000;
                $pph21 = ($pkp * 30 / 100) + (500000000 * 25 / 100) + (250000000 * 15 / 100) + (60000000 * 5 / 100);
            } elseif ($pkp > 5000000000) {
                $pkp -= 60000000 + 250000000 + 500000000 + 5000000000;
                $pph21 = ($pkp * 35 / 100) + (5000000000 * 30 / 100) + (500000000 * 25 / 100) + (250000000 * 15 / 100) + (60000000 * 5 / 100);
            }
                
                $penggajian->gaji_bersih = $bruto - ($pph21 / 12) - $penggajian->total_pinjaman;
            }

            $html = view('laporan.penggajian', compact('penggajians'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            return $dompdf->stream('laporan_penggajian.pdf');
        }

}

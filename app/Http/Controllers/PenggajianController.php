<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Penggajian;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\Pinjaman;
use Dompdf\Dompdf;

class PenggajianController extends Controller
{
    //
    public function index() : View
    {
        $penggajians = Penggajian::latest()->paginate(8);

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

        return view('penggajian.index', compact('penggajians'));
    }

    public function search(Request $request) : View
    {
        $query = $request->input('search');
        $penggajians = Penggajian::join('karyawans', 'penggajians.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->where('penggajians.kode_karyawan', 'like', "%{$query}%")
            ->orWhere('karyawans.nama_karyawan', 'like', "%{$query}%")
            ->orWhere('penggajians.tanggal', 'like', "%{$query}%")
            ->orWhere('penggajians.periode_gaji', 'like', "%{$query}%")
            ->paginate(8);
        
        return view('penggajian.index', compact('penggajians'));
    }

    public function create(): View
    {
        $karyawans = Karyawan::all();
        return view('penggajian.create', compact('karyawans'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
            'numeric' => ':attribute harus berupa angka',
        ];

        $request->validate([
            'periode_gaji' => 'required',
            'tanggal' => 'required',
            'kode_karyawan' => 'required|min:3',
            'gaji_pokok' => 'required|numeric',
            'tunj_transport' => 'required|numeric',
            'tunj_makan' => 'required|numeric',
            'total_lembur' => 'required|numeric',
            'total_bonus' => 'required|numeric',
            'total_pinjaman' => 'required|numeric',
            'ptkp' => 'required|numeric',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        Penggajian::create([
            'periode_gaji' => $request->periode_gaji,
            'tanggal' => $request->tanggal,
            'kode_karyawan'  => $request->kode_karyawan,
            'gaji_pokok'  => $request->gaji_pokok,
            'tunj_transport'  => $request->tunj_transport,
            'tunj_makan'  => $request->tunj_makan,
            'total_lembur'  => $request->total_lembur,
            'total_bonus'  => $request->total_bonus,
            'total_pinjaman'  => $request->total_pinjaman,
            'ptkp'  => $request->ptkp,
        ]);

         // Update status_lunas to 'Lunas'
        if ($request->total_pinjaman > 0) {
            Pinjaman::where('kode_karyawan', $request->kode_karyawan)
                    ->where('status_lunas', 'Belum Lunas')
                    ->update(['status_lunas' => 'Lunas']);
        }

        //redirect to index
        return redirect()->route('penggajian.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function getLemburDetails($kode_karyawan)
    {
        // Dapatkan karyawan berdasarkan kode_karyawan
        $karyawan = Karyawan::with('bagian')->where('kode_karyawan', $kode_karyawan)->first();

        // Hitung total lembur
        if ($karyawan) {
            $uangLembur = $karyawan->bagian->uang_lembur;
            $totalLembur = Lembur::where('kode_karyawan', $kode_karyawan)->count() * $uangLembur;
            return response()->json(['total_lembur' => $totalLembur]);
        }

        return response()->json(['total_lembur' => 0]);
    }

    public function getPinjamanDetails($kode_karyawan)
    {
        $totalPinjaman = Pinjaman::where('kode_karyawan', $kode_karyawan)
                            ->where('status_lunas', 'Belum Lunas')
                            ->sum('besar_pinjaman');

        return response()->json(['total_pinjaman' => $totalPinjaman]);
    }
    
    public function show(string $id): View
    {
        $penggajian = Penggajian::findOrFail($id);

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

        $gaji_bersih = $bruto - ($pph21 / 12) - $penggajian->total_pinjaman;

        return view('penggajian.show', compact('penggajian', 'gaji_total', 'bpjs_kesehatan', 'bpjs_jkk', 'bpjs_jkm', 'bruto','biaya_jabatan', 'bpjs_jht', 'bpjs_jp', 'neto','pkp', 'pph21', 'gaji_bersih'));
    }

    public function edit(string $id): View
    {
        $penggajian = Penggajian::findOrFail($id);
        $karyawans = Karyawan::all();

        return view('penggajian.edit', compact('penggajian', 'karyawans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'periode_gaji' => 'required',
            'tanggal' => 'required',
            'kode_karyawan' => 'required|min:3',
            'gaji_pokok' => 'required|numeric',
            'tunj_transport' => 'required|numeric',
            'tunj_makan' => 'required|numeric',
            'total_lembur' => 'required|numeric',
            'total_bonus' => 'required|numeric',
            'total_pinjaman' => 'required|numeric',
            'ptkp' => 'required|numeric',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        $penggajian = Penggajian::findOrFail($id);
        $penggajian->update([
            'periode_gaji' => $request->periode_gaji,
            'tanggal' => $request->tanggal,
            'kode_karyawan'  => $request->kode_karyawan,
            'gaji_pokok'  => $request->gaji_pokok,
            'tunj_transport'  => $request->tunj_transport,
            'tunj_makan'  => $request->tunj_makan,
            'total_lembur'  => $request->total_lembur,
            'total_bonus'  => $request->total_bonus,
            'total_pinjaman'  => $request->total_pinjaman,
            'ptkp'  => $request->ptkp,
        ]);

        // Update status_lunas to 'Lunas'
        if ($request->total_pinjaman > 0) {
            Pinjaman::where('kode_karyawan', $request->kode_karyawan)
                    ->where('status_lunas', 'Belum Lunas')
                    ->update(['status_lunas' => 'Lunas']);
        }

        return redirect()->route('penggajian.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $penggajian = Penggajian::findOrFail($id);

        $penggajian->delete();

        return redirect()->route('penggajian.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function export($id)
    {
        $penggajian = Penggajian::findOrFail($id);

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

        $gaji_bersih = $bruto - ($pph21 / 12) - $penggajian->total_pinjaman;

        // Convert image to base64
        $path = public_path('images/jangar.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $html = view('penggajian.notagaji', compact('penggajian', 'gaji_total', 'bpjs_kesehatan', 'bpjs_jkk', 'bpjs_jkm', 'bruto','biaya_jabatan', 'bpjs_jht', 'bpjs_jp', 'neto','pkp', 'pph21', 'gaji_bersih', 'base64'))->render();

        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('notagaji-' . $penggajian->karyawan->nama_karyawan . '.pdf');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Lembur;
use App\Models\Karyawan;

class LemburController extends Controller
{
    //
    public function index() : View
    {
        $lemburs = Lembur::latest()->paginate(8);

        return view('lembur.index', compact('lemburs'));
    }

    public function search(Request $request) : View
    {
        $query = $request->input('search');
        $lemburs = Lembur::join('karyawans', 'lemburs.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->where('lemburs.kode_karyawan', 'like', "%{$query}%")
            ->orWhere('karyawans.nama_karyawan', 'like', "%{$query}%")
            ->orWhere('lemburs.tanggal', 'like', "%{$query}%")
            ->orWhere('lemburs.keterangan', 'like', "%{$query}%")
            ->paginate(8);
        
        return view('lembur.index', compact('lemburs'));
    }

    public function create(): View
    {
        $karyawans = Karyawan::all();
        return view('lembur.create', compact('karyawans'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'kode_karyawan' => 'required|min:3',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        Lembur::create([
            'kode_karyawan' => $request->kode_karyawan,
            'tanggal' => $request->tanggal,
            'keterangan'  => $request->keterangan,
        ]);

        //redirect to index
        return redirect()->route('lembur.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $lembur = Lembur::findOrFail($id);
        $karyawans = Karyawan::all();

        return view('lembur.edit', compact('lembur', 'karyawans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'kode_karyawan' => 'required|min:3',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        $lembur = Lembur::findOrFail($id);
        $lembur->update([
            'kode_karyawan' => $request->kode_karyawan,
            'tanggal'  => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('lembur.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $lembur = Lembur::findOrFail($id);

        $lembur->delete();

        return redirect()->route('lembur.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}

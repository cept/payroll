<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Pinjaman;
use App\Models\Karyawan;

class PinjamanController extends Controller
{
    //
    public function index() : View
    {
        $pinjamans = Pinjaman::latest()->paginate(8);

        return view('pinjaman.index', compact('pinjamans'));
    }

    public function search(Request $request) : View
    {
        $query = $request->input('search');
        $pinjamans = Pinjaman::join('karyawans', 'pinjamans.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->where('pinjamans.kode_karyawan', 'like', "%{$query}%")
            ->orWhere('karyawans.nama_karyawan', 'like', "%{$query}%")
            ->orWhere('pinjamans.tanggal', 'like', "%{$query}%")
            ->orWhere('pinjamans.keterangan', 'like', "%{$query}%")
            ->orWhere('pinjamans.status_lunas', 'like', "%{$query}%")
            ->paginate(8);
        
        return view('pinjaman.index', compact('pinjamans'));
    }

    public function create(): View
    {
        $karyawans = Karyawan::all();
        return view('pinjaman.create', compact('karyawans'));
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
            'besar_pinjaman' => 'required|numeric',
            'keterangan' => 'required',
            'status_lunas' => 'required',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        Pinjaman::create([
            'kode_karyawan' => $request->kode_karyawan,
            'tanggal' => $request->tanggal,
            'besar_pinjaman'  => $request->besar_pinjaman,
            'keterangan'  => $request->keterangan,
            'status_lunas'  => $request->status_lunas,
        ]);

        //redirect to index
        return redirect()->route('pinjaman.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $karyawans = Karyawan::all();

        return view('pinjaman.edit', compact('pinjaman', 'karyawans'));
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
            'besar_pinjaman' => 'required|numeric',
            'keterangan' => 'required',
            'status_lunas' => 'required',
        ], $messages);

        $karyawanExists = Karyawan::where('kode_karyawan', $request->kode_karyawan)->exists();

        if (!$karyawanExists) {
            return redirect()->back()->withErrors(['kode_karyawan' => 'Kode Karyawan tidak sesuai dengan data yang ada.'])->withInput();
        }

        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'kode_karyawan' => $request->kode_karyawan,
            'tanggal'  => $request->tanggal,
            'besar_pinjaman' => $request->besar_pinjaman,
            'keterangan' => $request->keterangan,
            'status_lunas' => $request->status_lunas,
        ]);

        return redirect()->route('pinjaman.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $pinjaman->delete();

        return redirect()->route('pinjaman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}

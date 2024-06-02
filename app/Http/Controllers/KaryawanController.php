<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Karyawan;
use App\Models\Bagian;
use Illuminate\Http\RedirectResponse;

class KaryawanController extends Controller
{
    //
    public function index() : View
    {
        $karyawans = Karyawan::with('bagian')->latest()->paginate(8);

        return view('karyawan.index', compact('karyawans'));
    }

    public function search(Request $request) : View
    {
        $query = $request->input('search');
        $karyawans = Karyawan::join('bagians', 'karyawans.kode_bagian', '=', 'bagians.kode_bagian')
            ->where('karyawans.kode_karyawan', 'like', "%{$query}%")
            ->orWhere('karyawans.nik', 'like', "%{$query}%")
            ->orWhere('karyawans.nama_karyawan', 'like', "%{$query}%")
            ->orWhere('karyawans.kode_bagian', 'like', "%{$query}%")
            ->orWhere('bagians.nama_bagian', 'like', "%{$query}%")
            ->orWhere('karyawans.kelamin', 'like', "%{$query}%")
            ->orWhere('karyawans.no_hp', 'like', "%{$query}%")
            ->paginate(8);
        
        return view('karyawan.index', compact('karyawans'));
    }

    public function create(): View
    {
        $bagians = Bagian::all();
        return view('karyawan.create', compact('bagians'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maximal :max karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'kode_karyawan' => 'required|unique:karyawans|min:3',
            'nik' => 'required|unique:karyawans|min:16|max:16',
            'nama_karyawan' => 'required|min:5',
            'kode_bagian' => 'required',
            'kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:10|max:15',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'tgl_masuk' => 'required',
        ], $messages);

        Karyawan::create([
            'kode_karyawan' => $request->kode_karyawan,
            'nik' => $request->nik,
            'nama_karyawan' => $request->nama_karyawan,
            'kode_bagian'  => $request->kode_bagian,
            'kelamin' => $request->kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'status' => $request->status,
            'tgl_masuk' => $request->tgl_masuk,
        ]);

        //redirect to index
        return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.show', compact('karyawan'));
    }

    public function edit(string $id): View
    {
        $karyawan = Karyawan::findOrFail($id);
        $bagians = Bagian::all();

        return view('karyawan.edit', compact('karyawan', 'bagians'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maximal :max karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'nik' => 'required|min:16|max:16',
            'nama_karyawan' => 'required|min:5',
            'kode_bagian' => 'required',
            'kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:10|max:15',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'tgl_masuk' => 'required',
        ], $messages);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nik' => $request->nik,
            'nama_karyawan'  => $request->nama_karyawan,
            'kode_bagian' => $request->kode_bagian,
            'kelamin' => $request->kelamin,
            'alamat' => $request->alamat,            
            'no_hp' => $request->no_hp,            
            'tempat_lahir' => $request->tempat_lahir,            
            'tgl_lahir' => $request->tgl_lahir,            
            'agama' => $request->agama,            
            'status' => $request->status,            
            'tgl_masuk' => $request->tgl_masuk,            
        ]);

        return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $karyawan = Karyawan::findOrFail($id);

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function getGaji($kode_karyawan)
    {
        $karyawan = Karyawan::where('kode_karyawan', $kode_karyawan)->with('bagian')->first();

        if ($karyawan) {
            return response()->json([
                'gaji_pokok' => $karyawan->bagian->gaji_pokok,
                'tunj_transport' => $karyawan->bagian->uang_transport,
                'tunj_makan' => $karyawan->bagian->uang_makan
            ]);
        } else {
            return response()->json(['error' => 'Karyawan not found'], 404);
        }
    }
    
}

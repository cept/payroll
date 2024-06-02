<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Bagian;
use Illuminate\Http\RedirectResponse;

class BagianController extends Controller
{
    //
    public function index() : View
    {
        $bagians = Bagian::latest()->paginate(8);

        return view('bagian.index', compact('bagians'));
    }

    public function search(Request $request) : View
    {
        $query = $request->input('search');
        $bagians = Bagian::where('nama_bagian', 'like', "%{$query}%")
            ->orWhere('kode_bagian', 'like', "%{$query}%")
            ->paginate(8);
        
        return view('bagian.index', compact('bagians'));
    }

    public function create(): View
    {
        return view('bagian.create');
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
            'kode_bagian' => 'required|unique:bagians|min:4',
            'nama_bagian' => 'required|min:5',
            'gaji_pokok' => 'required|numeric',
            'uang_transport' => 'required|numeric',
            'uang_makan' => 'required|numeric',
            'uang_lembur' => 'required|numeric',
            'bpjs_kesehatan' => 'numeric',
            'bpjs_jkk' => 'numeric',
            'bpjs_jkm' => 'numeric',
            'bpjs_jht' => 'numeric',
            'bpjs_jp' => 'numeric',
        ], $messages);

        Bagian::create([
            'kode_bagian' => $request->kode_bagian,
            'nama_bagian' => $request->nama_bagian,
            'gaji_pokok'  => $request->gaji_pokok,
            'uang_transport' => $request->uang_transport,
            'uang_makan' => $request->uang_makan,
            'uang_lembur' => $request->uang_lembur,
            'bpjs_kesehatan' => $request->bpjs_kesehatan,
            'bpjs_jkk' => $request->bpjs_jkk,
            'bpjs_jkm' => $request->bpjs_jkm,
            'bpjs_jht' => $request->bpjs_jht,
            'bpjs_jp' => $request->bpjs_jp,
        ]);

        //redirect to index
        return redirect()->route('bagian.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $bagian = Bagian::findOrFail($id);

        return view('bagian.show', compact('bagian'));
    }

    public function edit(string $id): View
    {
        $bagian = Bagian::findOrFail($id);

        return view('bagian.edit', compact('bagian'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $request->validate([
            'nama_bagian' => 'required|min:5',
            'gaji_pokok' => 'required|numeric',
            'uang_transport' => 'required|numeric',
            'uang_makan' => 'required|numeric',
            'uang_lembur' => 'required|numeric',
            'bpjs_kesehatan' => 'numeric',
            'bpjs_jkk' => 'numeric',
            'bpjs_jkm' => 'numeric',
            'bpjs_jht' => 'numeric',
            'bpjs_jp' => 'numeric',
        ], $messages);

        $bagian = Bagian::findOrFail($id);
        $bagian->update([
            'nama_bagian' => $request->nama_bagian,
            'gaji_pokok'  => $request->gaji_pokok,
            'uang_transport' => $request->uang_transport,
            'uang_makan' => $request->uang_makan,
            'uang_lembur' => $request->uang_lembur,            
            'bpjs_kesehatan' => $request->bpjs_kesehatan,
            'bpjs_jkk' => $request->bpjs_jkk,
            'bpjs_jkm' => $request->bpjs_jkm,
            'bpjs_jht' => $request->bpjs_jht,
            'bpjs_jp' => $request->bpjs_jp,
        ]);

        return redirect()->route('bagian.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $bagian = Bagian::findOrFail($id);

        $bagian->delete();

        return redirect()->route('bagian.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}

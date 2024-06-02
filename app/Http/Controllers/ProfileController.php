<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $users = User::latest()->paginate(8);

        return view('managementuser.index', compact('users'));
    }

    public function create()
    {
        return view('managementuser.create');
    }

    public function store(Request $request)
    {
        //validate form
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'is_admin' => 'required',
        ], $messages);
        
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/imageusers', $image->hashName());

        $validated['image'] = $image->hashName();
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);


        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('managementuser.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute sudah digunakan',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa file tipe: :values',
            'max' => ':attribute ukuran maksimal adalah :max kilobyte',
        ];

        // Validasi umum
        $rules = [
            'name' => 'required|min:5',
            'is_admin' => 'required',
        ];

        // Validasi untuk password jika diisi
        if (!empty($request->input('password'))) {
            $rules['password'] = 'min:5';
        }

        // Validasi untuk gambar jika diupload
        if ($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
        }

        $request->validate($rules, $messages);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Update password jika diisi
        if (!empty($request->input('password'))) {
            $request['password'] = Hash::make($request['password']);
            $user->password = $request['password'];
        }

        // Update gambar jika diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/imageusers', $image->hashName());

            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('public/imageusers/'.$user->image);
            }

            $user->image = $image->hashName();
        }

        // Update data user lainnya
        $user->name = $request->name;
        $user->is_admin = $request->is_admin;

        // Simpan perubahan
        $user->save();

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Storage::delete('public/imageusers/'.$user->image);

        $user->delete();

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

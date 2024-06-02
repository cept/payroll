<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bagian;
use App\Models\Karyawan;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahUser = User::count();
        $jumlahKaryawan = Karyawan::count();
        $jumlahBagian = Bagian::count();

        return view('dashboard', compact('jumlahKaryawan', 'jumlahBagian', 'jumlahUser'));
    }
}

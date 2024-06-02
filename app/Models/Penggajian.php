<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode_gaji',
        'tanggal',
        'kode_karyawan',
        'gaji_pokok',
        'tunj_transport',
        'tunj_makan',
        'total_lembur',
        'total_bonus',
        'total_pinjaman',
        'ptkp',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'kode_karyawan', 'kode_karyawan');
    }
}

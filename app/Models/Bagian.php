<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_bagian',
        'nama_bagian',
        'gaji_pokok',
        'uang_transport',
        'uang_makan',
        'uang_lembur',
        'bpjs_kesehatan',
        'bpjs_jkk',
        'bpjs_jkm',
        'bpjs_jht',
        'bpjs_jp',
    ];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'kode_bagian', 'kode_bagian');
    }
}

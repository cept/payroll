<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_karyawan',
        'nik',
        'nama_karyawan',
        'kode_bagian',
        'kelamin',
        'alamat',
        'no_hp',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'status',
        'tgl_masuk',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_masuk' => 'date',
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'kode_bagian', 'kode_bagian');
    }

    public function lemburs()
    {
        return $this->hasMany(Lembur::class, 'kode_karyawan', 'kode_karyawan');
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class, 'kode_karyawan', 'kode_karyawan');
    }

    public function penggajians()
    {
        return $this->hasMany(Penggajian::class, 'kode_karyawan', 'kode_karyawan');
    }
}

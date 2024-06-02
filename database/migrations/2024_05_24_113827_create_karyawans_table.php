<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_karyawan')->unique();
            $table->string('nik');
            $table->string('nama_karyawan');
            $table->string('kode_bagian');
            $table->string('kelamin');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->string('status');
            $table->date('tgl_masuk');
            $table->timestamps();

            // Tambahkan definisi foreign key
            $table->foreign('kode_bagian')->references('kode_bagian')->on('bagians')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};

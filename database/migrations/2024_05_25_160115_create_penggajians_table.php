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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->string('periode_gaji');
            $table->date('tanggal');
            $table->string('kode_karyawan');
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('tunj_transport');
            $table->bigInteger('tunj_makan');
            $table->bigInteger('total_lembur');
            $table->bigInteger('total_bonus');
            $table->bigInteger('total_pinjaman');
            $table->bigInteger('ptkp');
            $table->timestamps();

            $table->foreign('kode_karyawan')->references('kode_karyawan')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};

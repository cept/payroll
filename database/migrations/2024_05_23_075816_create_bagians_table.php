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
        Schema::create('bagians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bagian')->unique();
            $table->string('nama_bagian');
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('uang_transport');
            $table->bigInteger('uang_makan');
            $table->bigInteger('uang_lembur');
            $table->Integer('bpjs_kesehatan');
            $table->decimal('bpjs_jkk');
            $table->decimal('bpjs_jkm');
            $table->Integer('bpjs_jht');
            $table->Integer('bpjs_jp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bagians');
    }
};

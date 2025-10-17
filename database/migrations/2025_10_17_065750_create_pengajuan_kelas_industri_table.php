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
    Schema::create('pengajuan_kelas_industri', function (Blueprint $table) {
        $table->id();

        $table->foreignId('id_siswa')->constrained('siswas')->cascadeOnDelete();
        $table->foreignId('id_lowongan')->constrained('lowongans')->cascadeOnDelete();
        $table->foreignId('id_posisi')->constrained('lowongan_posisis')->cascadeOnDelete();

        $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
        $table->text('catatan')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kelas_industri');
    }
};

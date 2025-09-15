<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kelas_industris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kelas', 30)->unique();
            $table->string('nama_kelas', 80);
            $table->year('angkatan');
            $table->integer('kapasitas')->default(0);
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kelas_industris');
    }
};

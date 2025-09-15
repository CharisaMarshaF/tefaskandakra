<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('nis', 30)->unique();
            $table->string('nisn', 30)->nullable();
            $table->string('nama_lengkap', 150);
            $table->enum('gender', ['L', 'P']);
            $table->date('TTL')->nullable();
            $table->text('alamat')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 150)->nullable();

            $table->foreignId('id_kelasindustri')->nullable()->constrained('kelas_industris')->nullOnDelete();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->nullOnDelete();
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();

            $table->year('angkatan');
            $table->enum('status', ['aktif', 'dropout', 'alumni'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('siswas');
    }
};

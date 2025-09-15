<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('nip', 30)->nullable();
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();
            $table->text('keahlian')->nullable();
            $table->string('jabatan', 80)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('gurus');
    }
};

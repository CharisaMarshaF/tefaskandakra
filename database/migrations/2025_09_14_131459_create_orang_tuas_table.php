<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_siswa')->constrained('siswas')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->string('phone', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('hubungan', ['Ayah', 'Ibu', 'Wali', 'Lainnya']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orang_tuas');
    }
};

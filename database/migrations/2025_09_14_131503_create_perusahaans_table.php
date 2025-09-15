<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('kode_perusahaan', 30)->unique();
            $table->string('nama', 150);
            $table->string('pic_name', 150);
            $table->string('pic_phone', 30)->nullable();
            $table->string('pic_email', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('perusahaans');
    }
};

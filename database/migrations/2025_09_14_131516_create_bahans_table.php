<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bahan', 40)->unique();
            $table->string('nama_bahan', 150);
            $table->string('jenis', 80)->nullable();
            $table->string('satuan', 20)->nullable();
            $table->integer('stok')->default(0);
            $table->integer('minimal_stok')->default(0);
            $table->decimal('harga_satuan', 12, 2)->default(0);
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bahans');
    }
};

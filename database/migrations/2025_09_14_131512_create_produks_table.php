<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 40)->unique();
            $table->string('nama_produk', 150);
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();
            $table->text('deskripsi')->nullable();
            $table->string('kategori', 80)->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('satuan', 20)->nullable();
            $table->integer('stok')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->foreignId('id_foto')->nullable()->constrained('fotos')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('produks');
    }
};

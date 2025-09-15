<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stok_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bahan')->constrained('bahans')->cascadeOnDelete();
            $table->enum('jenis', ['masuk', 'keluar', 'adjust']);
            $table->integer('qty');
            $table->dateTime('tanggal');
            $table->string('reference', 150)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stok_transaksis');
    }
};

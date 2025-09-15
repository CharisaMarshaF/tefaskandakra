<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('jadwal_produksi', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_project');
        $table->unsignedBigInteger('id_kelasindustri');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->text('catatan')->nullable();
        $table->timestamps();

        $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('id_kelasindustri')->references('id')->on('kelas_industris')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_produksi');
    }
};

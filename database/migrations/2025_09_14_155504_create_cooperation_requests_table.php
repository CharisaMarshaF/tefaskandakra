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
    Schema::create('cooperation_requests', function (Blueprint $table) {
        $table->id();
        $table->string('nama_perusahaan', 255);
        $table->string('kode_tiket', 50);
        $table->string('alamat_perusahaan', 255);
        $table->string('bidang_usaha', 150);
        $table->string('kontak_person', 150);
        $table->string('no_telp', 50);
        $table->string('email', 100);

        $table->string('jenis_kerjasama', 150);
        $table->text('deskripsi_kebutuhan');
        $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
        $table->text('catatan_admin')->nullable();
        $table->date('tanggal_pengajuan');
        $table->timestamp('tanggal_update')->useCurrent();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperation_requests');
    }
};

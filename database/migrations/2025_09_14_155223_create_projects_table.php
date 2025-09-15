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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('kode_project', 40);
        $table->string('nama_project', 150);
        $table->text('deskripsi')->nullable();
        
        $table->unsignedBigInteger('id_guru');
        $table->unsignedBigInteger('id_perusahaan');
        $table->unsignedBigInteger('id_jurusan');
        $table->unsignedBigInteger('id_kelasindustri');

        $table->date('start_date');
        $table->date('deadline');
        $table->enum('status', ['draft', 'pending', 'proses', 'selesai', 'dibatalkan']);
        $table->text('expected_output')->nullable();
        
        $table->timestamps();

        // Foreign Keys
        $table->foreign('id_guru')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_perusahaan')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
        $table->foreign('id_kelasindustri')->references('id')->on('kelas_industris')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

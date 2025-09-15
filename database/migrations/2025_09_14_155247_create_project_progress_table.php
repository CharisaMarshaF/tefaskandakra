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
    Schema::create('project_progress', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_project');
        $table->unsignedBigInteger('id_siswa');
        $table->dateTime('tanggal');
        $table->tinyInteger('progress_percent');
        $table->text('deskripsi')->nullable();
        $table->unsignedBigInteger('file_id')->nullable();
        $table->unsignedBigInteger('submitted_by');
        $table->timestamps();

        // Foreign Keys
        $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('id_siswa')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
        $table->foreign('submitted_by')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_progress');
    }
};

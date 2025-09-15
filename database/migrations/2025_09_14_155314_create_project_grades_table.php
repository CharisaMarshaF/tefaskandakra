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
    Schema::create('project_grades', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_project');
        $table->unsignedBigInteger('id_siswa');
        $table->decimal('nilai', 5, 2)->nullable();
        $table->text('feedback')->nullable();
        $table->unsignedBigInteger('sertifikat_file_id')->nullable();
        $table->unsignedBigInteger('graded_by');
        $table->dateTime('graded_at');
        $table->timestamps();

        // Foreign Keys
        $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('id_siswa')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('sertifikat_file_id')->references('id')->on('files')->onDelete('set null');
        $table->foreign('graded_by')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_grades');
    }
};

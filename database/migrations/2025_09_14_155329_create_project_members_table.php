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
    Schema::create('project_members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_project');
        $table->unsignedBigInteger('id_siswa');
        $table->string('role', 80);
        $table->dateTime('assigned_at');
        $table->timestamps();

        $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
        $table->foreign('id_siswa')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};

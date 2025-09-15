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
    Schema::create('cs_tickets', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_user');
        $table->string('kode_tiket', 50);
        $table->string('subject', 150);
        $table->text('message');
        $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
        $table->unsignedBigInteger('assigned_to')->nullable();
        $table->text('catatan_admin')->nullable();
        $table->timestamps();

        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cs_tickets');
    }
};

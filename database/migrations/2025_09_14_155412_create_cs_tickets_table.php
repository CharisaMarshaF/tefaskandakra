<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cs_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // Pelapor
            $table->string('kode_tiket', 50)->unique();
            $table->string('subject', 150);
            $table->text('message');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');

            $table->unsignedBigInteger('assigned_to')->nullable(); // Admin yang menangani
            $table->text('catatan_admin')->nullable();

            // Relasi ke file lampiran
            $table->foreignId('id_file')
                  ->nullable()
                  ->constrained('files')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->timestamps();

            // Relasi ke tabel users
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

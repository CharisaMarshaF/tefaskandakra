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
        Schema::create('tracking_logs', function (Blueprint $table) {
            $table->id('id_log');

            // Opsional: Bisa dari cs_tickets atau cooperation_requests
            $table->unsignedBigInteger('id_ticket')->nullable();
            $table->unsignedBigInteger('id_req')->nullable();

            $table->enum('status', ['menunggu', 'ditindaklanjuti', 'selesai', 'ditolak']);
            $table->text('keterangan')->nullable();

            // User yang melakukan perubahan status
            $table->unsignedBigInteger('changed_by');
            $table->dateTime('changed_at');

            $table->timestamps();

            // Foreign key ke CS Tickets
            $table->foreign('id_ticket')
                ->references('id')->on('cs_tickets')
                ->onDelete('cascade');

            // Foreign key ke Cooperation Requests
            $table->foreign('id_req')
                ->references('id')->on('cooperation_requests')
                ->onDelete('cascade');

            // Foreign key ke Users
            $table->foreign('changed_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_logs');
    }
};

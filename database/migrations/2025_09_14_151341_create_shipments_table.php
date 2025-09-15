<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('orders')->onDelete('cascade');
            $table->string('courier', 80);
            $table->string('tracking_no', 100)->nullable();
            $table->enum('status', ['packed', 'shipped', 'in_transit', 'delivered'])->default('packed');
            $table->foreignId('packed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

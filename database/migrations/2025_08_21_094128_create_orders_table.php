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
        Schema::create('orders', function (Blueprint $table) {
        $table->id('order_id');
        $table->foreignId('user_id')->constrained('users', column: 'user_id')->onDelete('cascade');
        $table->decimal('total_amount', 10, 2);
        $table->enum('status', ['pending', 'processing', 'out_for_delivery', 'completed', 'cancelled'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

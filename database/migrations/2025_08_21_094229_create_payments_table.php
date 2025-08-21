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
        Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');
        $table->foreignId('order_id')->constrained('orders', column:'order_id')->onDelete('cascade');
        $table->enum('method', ['cod', 'gcash', 'bank'])->default('cod');
        $table->enum('status', ['unpaid', 'paid', 'failed'])->default('unpaid');
        $table->timestamp('paid_at')->nullable();
        $table->string('reference_no')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

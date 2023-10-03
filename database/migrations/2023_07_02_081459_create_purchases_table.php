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
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('CASCADE');
            $table->string('order_number');
            $table->date('order_date');
            $table->date('due_date');
            $table->string('branch');
            $table->string('responsible_person');
            $table->longText('note')->nullable();
            $table->boolean('status')->default(false);
            $table->decimal('total_price');
            $table->enum('payment_status', ['paid', 'waiting', 'missing']);
            $table->string('payment_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

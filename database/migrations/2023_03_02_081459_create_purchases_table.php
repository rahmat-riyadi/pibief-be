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
            $table->id();
            $table->uuid();
            $table->string('vendor');
            $table->string('order_number');
            $table->string('order_date');
            $table->string('due_date');
            $table->string('warehouse');
            $table->string('tag');
            $table->string('responsible_person');
            $table->longText('note');
            $table->string('status');
            $table->decimal('total_price');
            $table->string('payment_status');
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

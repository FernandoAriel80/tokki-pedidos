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
            $table->id();
            $table->foreignUlid('user_id')->constrained('users');
            $table->string('product_title', 100);
            $table->string('customer_name', 100);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_finished')->default(false);
            $table->date('delivery_date');
            $table->date('finished_date')->nullable();
            $table->timestamps();


            $table->index('user_id');
            $table->index('is_finished');
            $table->index('delivery_date');
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

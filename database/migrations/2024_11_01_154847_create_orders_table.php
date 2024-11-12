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
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('order_number')->unique();
            $table->string('name');
            $table->integer('state')->default(0);
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->integer('total_price');
            $table->integer('sub_total_price');
            $table->integer('shipping_price')->nullable();
            $table->integer('discount')->nullable();
            $table->foreignId('wilaya_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('commune_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('delivery_state')->default(0);
            $table->integer('payment_method')->default(0);
            $table->integer('payment_state')->default(0);
            $table->string('tracking')->nullable();
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

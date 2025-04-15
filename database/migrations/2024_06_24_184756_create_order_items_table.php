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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('address');
            $table->string('neighbourhood');
            $table->unsignedBigInteger('order_id');
            $table->string('product');
            $table->string('ammount');
            $table->string('month');
            $table->string('year');
            $table->string('value');
            $table->string('comments')->nullable();
            $table->string('product_img')->nullable();
            $table->timestamps();

//            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

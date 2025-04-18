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
            $table->string('user_id');
            $table->string('status');
            $table->string('value');
            $table->string('day');
            $table->string('month');
            $table->string('year');
            $table->string('user_name');
            $table->string('userAdress');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('complement')->nullable();
            $table->string('contact');
            $table->string('paymentMode');
            $table->string('change')->nullable();
            $table->string('delivery_man')->nullable();
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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

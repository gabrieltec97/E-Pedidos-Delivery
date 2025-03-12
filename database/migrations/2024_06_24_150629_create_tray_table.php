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
        Schema::create('trays', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('product');
            $table->string('product_id');
            $table->string('value');
            $table->string('ammount');
            $table->string('additionals');
            $table->string('coupon_apply');
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->string('city')->nullable();
            $table->string('complement')->nullable();
            $table->bigInteger('contact')->nullable();
            $table->integer('number')->nullable();
            $table->string('comments')->nullable();
            $table->string('paymentMode')->nullable();
            $table->string('change')->nullable();
            $table->string('sendingValue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tray');
    }
};

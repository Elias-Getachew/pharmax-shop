<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Migration for Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Assuming 'users' table for both customers and doctors
            $table->string('user_name'); // Add user name
            $table->string('card_number'); // Add card number
            $table->string('order_code')->unique();
            $table->string('status')->default('pending');
            $table->decimal('total_amount', 10, 2)->default(0); // Add total amount column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

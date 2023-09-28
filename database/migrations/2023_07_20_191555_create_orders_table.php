<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('user_id')->constrained();

            $table->string('status')->default(OrderStatus::PENDING->value);
            $table->decimal('grand_total', 12, 2);

            $table->string('payment_status')->default(PaymentStatus::PENDING->value);
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->unique()->nullable();
            $table->string('currency')->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('apartment');
            $table->string('floor');
            $table->string('street');
            $table->string('building');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal_code');
            $table->text('notes')->nullable();

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

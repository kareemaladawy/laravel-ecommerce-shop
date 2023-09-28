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
            $table->foreignId('order_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->text('description')
                ->nullable();
            $table->json('attributes')
                ->nullable();
            $table->decimal('price');
            $table->unsignedInteger('qty');
            $table->timestamps();
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

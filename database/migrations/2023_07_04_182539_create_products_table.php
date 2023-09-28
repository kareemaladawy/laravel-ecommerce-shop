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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('images')->nullable();
            $table->foreignId('brand_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('model')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->text('details')
                ->nullable();
            $table->unsignedInteger('qty')
                ->nullable();
            $table->decimal('unit_price', 8, 2);
            $table->decimal('sale_price', 8, 2)
                ->nullable();
            $table->decimal('weight', 8, 2)
                ->nullable();
            $table->boolean('active')
                ->default(1);
            $table->boolean('featured')
                ->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

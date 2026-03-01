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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variation_id')->constrained('item_variations')->onDelete('cascade');
            $table->foreignId('officer_id')->nullable()->constrained()->onDelete('set null'); // Null for Stock-In
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Operator who processes it
            $table->enum('type', ['in', 'out']);
            $table->unsignedInteger('quantity');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

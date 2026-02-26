<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slugs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Polymorphic relationship fields
            $table->unsignedBigInteger('sluggable_id');
            $table->string('sluggable_type');

            // Track which slug is the active one
            $table->boolean('is_current')->default(true);

            $table->timestamps();

            // Optional: index for faster lookups
            $table->index(['sluggable_id', 'sluggable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slugs');
    }
};

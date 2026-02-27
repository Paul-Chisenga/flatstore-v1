<?php

use App\Enums\ShippingMethodName;
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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ShippingMethodName::values()); // e.g., "Standard", "Express"
            $table->string('description')->nullable(); // optional details like "3–5 business days"
            $table->integer('estimated_days')->nullable(); // numeric delivery estimate
            $table->boolean('is_active')->default(true); // platform can toggle availability
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};

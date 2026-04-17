<?php

use App\Models\ProductAttributeValue;
use App\Models\ProductVariation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variation_attribute_value', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductVariation::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductAttributeValue::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['product_variation_id', 'product_attribute_value_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variation_attribute_value');
    }
};

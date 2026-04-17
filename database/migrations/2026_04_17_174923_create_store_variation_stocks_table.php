<?php

use App\Models\ProductVariation;
use App\Models\Store;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_variation_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Store::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductVariation::class)->constrained()->cascadeOnDelete();
            $table->integer('stock')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['store_id', 'product_variation_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_variation_stocks');
    }
};

<?php

use App\Enums\ProductMediaType;
use App\Models\Product;
use App\Models\ProductVariation;
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
        Schema::create('product_media', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductVariation::class)->nullable()->constrained()->nullOnDelete();

            $table->enum('type', ProductMediaType::values())->default(ProductMediaType::IMAGE->value); // image, video, thumbnail
            $table->boolean('is_primary')->default(false); // mark main image

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_media');
    }
};

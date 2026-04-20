<?php

use App\Enums\ProductStatus;
use App\Models\Brand;
use App\Models\Seller;
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
            $table->text('description')->nullable();
            $table->enum('status', ProductStatus::values())->default(ProductStatus::Draft->value);
            // $table->json('seller_shipping_method_ids')->nullable();
            $table->string('thumbnail_path');

            $table->foreignIdFor(Brand::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
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

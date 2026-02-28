<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_oders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Shop::class)->nullable()->constrained()->cascadeOnDelete(); // Optional association with a shop
            $table->decimal('total', 10, 2);
            $table->enum('status', OrderStatus::values())->default(OrderStatus::PENDING->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_oders');
    }
};

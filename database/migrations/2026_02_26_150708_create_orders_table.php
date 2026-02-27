<?php

use App\Enums\OrderFufillmentType;
use App\Enums\OrderStatus;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\ShippingAddress;
use App\Models\ShippingMethod;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Buyer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Shop::class)->nullable()->constrained()->cascadeOnDelete(); // Optional association with a shop
            $table->decimal('total', 10, 2);
            $table->enum('status', OrderStatus::values())->default(OrderStatus::PENDING->value);

            // Fulfillment & shipping
            $table->enum('fulfillment_type', OrderFufillmentType::values());
            $table->foreignIdFor(ShippingMethod::class)->constrained();
            $table->foreignIdFor(ShippingAddress::class)->constrained();
            $table->json('shipping_snapshot')->nullable();

            // Payments
            // $table->foreignId('payment_method_id')->constrained('payment_methods');
            // $table->decimal('total_amount', 12, 2);
            // $table->string('currency', 3);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

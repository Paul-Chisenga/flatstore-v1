<?php

use App\Enums\OrderFufillmentType;
use App\Enums\OrderPaymentStatus;
use App\Models\Buyer;
use App\Models\PaymentMethod;
use App\Models\ShippingAddress;
use App\Models\ShippingMethod;
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

            // Fulfillment & shipping
            $table->enum('fulfillment_type', OrderFufillmentType::values());
            $table->foreignIdFor(ShippingMethod::class)->constrained();
            $table->foreignIdFor(ShippingAddress::class)->constrained();

            // Payments
            $table->foreignIdFor(PaymentMethod::class)->constrained();
            $table->enum('payment_status', OrderPaymentStatus::values())->default(OrderPaymentStatus::PENDING->value);

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

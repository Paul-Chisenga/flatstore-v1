<?php

use App\Enums\OrderPaymentStatus;
use App\Models\Buyer;
use App\Models\PaymentMethod;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Buyer::class)->constrained()->cascadeOnDelete();

            // Payments
            $table->foreignIdFor(model: PaymentMethod::class)->constrained();
            $table->enum('payment_status', OrderPaymentStatus::values());

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

<?php

use App\Enums\PaymentMethodName;
use App\Enums\PaymentMethodProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->enum('name', PaymentMethodName::values()); // e.g. Card, Wallet, COD
            $table->enum('provider', PaymentMethodProvider::values())->nullable(); // e.g. Visa, PayPal, "MTN Momo"
            $table->boolean('is_active')->default(true); // platform can toggle availability
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};

<?php

use App\Enums\PayoutStatus;
use App\Models\PayoutMethod;
use App\Models\SubOrder;
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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubOrder::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PayoutMethod::class)->constrained();

            $table->decimal('amount', 12, 2); // seller’s share
            $table->string('currency', 3);
            $table->enum('status', PayoutStatus::values())->default(PayoutStatus::PENDING->value);
            $table->string('transaction_reference')->nullable(); // bank/mobile money ref
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};

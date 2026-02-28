<?php

use App\Models\PayoutMethod;
use App\Models\Seller;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_payout_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PayoutMethod::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_enabled')->default(true); // seller opts in/out
            $table->string('details')->nullable(); // e.g., bank account number, mobile wallet ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_payout_methods');
    }
};

<?php

use App\Enums\PayoutMethodName;
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
        Schema::create('payout_methods', function (Blueprint $table) {
            $table->id();
            $table->enum('name', PayoutMethodName::values());
            $table->string('description')->nullable(); // optional details
            $table->string('currency', 3)->nullable(); // if method is currency-specific
            $table->boolean('is_active')->default(true); // platform can toggle availability
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_methods');
    }
};

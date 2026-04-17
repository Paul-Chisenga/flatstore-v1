<?php

use App\Enums\SellerRole;
use App\Models\Seller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Store::class)->nullable()->constrained()->nullOnDelete(); // Optional association with a store
            $table->enum('role', SellerRole::values())->default(SellerRole::Owner->value);
            $table->timestamps();

            $table->unique(['seller_id', 'user_id', 'store_id']); // Ensure a user can only have one role per seller/store combination
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_users');
    }
};

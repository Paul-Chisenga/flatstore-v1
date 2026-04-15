<?php

use App\Enums\SellerRole;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('role', SellerRole::values())->default(SellerRole::Owner->value);
            $table->timestamps();

            $table->unique(['seller_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_users');
    }
};

<?php

namespace App\Models;

use App\Enums\SellerRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SellerUser extends Pivot
{
    protected $table = 'seller_users';

    protected $casts = ['role' => SellerRole::class];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

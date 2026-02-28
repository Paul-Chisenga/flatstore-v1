<?php

namespace App\Models;

use App\Enums\SellerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    protected $fillable = ['type'];

    protected $casts = ['type' => SellerType::class];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingMethods(): HasMany
    {
        return $this->hasMany(SellerShippingMethod::class);
    }

    public function payoutMethods(): HasMany
    {
        return $this->hasMany(SellerPayoutMethod::class);
    }
}

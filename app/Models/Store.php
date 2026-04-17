<?php

namespace App\Models;

use App\Traits\HasAddress;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasAddress;

    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = ['seller_id', 'name', 'logo_path', 'contact_email', 'phone_number'];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function variationStocks(): HasMany
    {
        return $this->hasMany(StoreVariationStock::class);
    }

    public function productVariations(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariation::class, 'store_variation_stocks')
            ->withPivot('stock', 'is_active')
            ->withTimestamps();
    }

    public function shippingMethods(): HasMany
    {
        return $this->hasMany(SellerShippingMethod::class);
    }
}

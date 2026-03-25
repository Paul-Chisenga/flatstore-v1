<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'seller_shipping_method_ids' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function shippingMethods()
    {

        // RUN WITH $products = Product::with('seller.shippingMethods.method')->get();

        $sellerMethods = $this->seller->relationLoaded('shippingMethods')
            ? $this->seller->shippingMethods
            : null;

        if ($sellerMethods) {
            // optionally eager‑load 'method' here as well
            $sellerMethods->loadMissing('method');

            if ($this->seller_shipping_method_ids) {
                return $sellerMethods
                    ->whereIn('id', $this->seller_shipping_method_ids);
            }

            return $sellerMethods;
        }

        // nothing pre‑loaded, run a query as before
        if ($this->seller_shipping_method_ids) {
            // Get product-specific seller shipping methods with their shipping method details
            return $this->seller->shippingMethods()
                ->whereIn('id', $this->seller_shipping_method_ids)
                ->with('method')
                ->get();
        }

        // Fall back to all seller's shipping methods
        return $this->seller->shippingMethods()
            ->with('method')
            ->get();
    }
}

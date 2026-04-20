<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'brand_id',
        'seller_id',
        'thumbnail_path',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'seller_shipping_method_ids' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function storeVariationStocks(): HasManyThrough
    {
        return $this->hasManyThrough(StoreVariationStock::class, ProductVariation::class);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function media(): HasMany
    {
        return $this->medias();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
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

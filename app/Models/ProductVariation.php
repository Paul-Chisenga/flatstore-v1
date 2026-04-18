<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariationFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'price',
        'weight',
        'width',
        'height',
        'depth',
        'is_default',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weight' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'depth' => 'decimal:2',
        'is_default' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductAttributeValue::class,
            'product_variation_attribute_values'
        )->withTimestamps();
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'store_variation_stocks')
            ->withPivot('stock', 'is_active')
            ->withTimestamps();
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(StoreVariationStock::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }
}

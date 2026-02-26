<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariationFactory> */
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'discount_percentage',
        'stock',
        'weight',
        'width',
        'height',
        'depth',
        'is_default'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }
}

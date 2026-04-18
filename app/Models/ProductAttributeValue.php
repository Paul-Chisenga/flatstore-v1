<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductAttributeValue extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAttributeValueFactory> */
    use HasFactory;

    protected $fillable = ['product_attribute_id', 'value'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductVariation::class,
            'product_variation_attribute_values'
        )->withTimestamps();
    }
}

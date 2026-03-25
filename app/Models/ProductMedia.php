<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ProductMedia extends Model
{
    /** @use HasFactory<\Database\Factories\ProductMediaFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'url',
        'is_primary',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function media(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerShippingMethod extends Model
{
    /** @use HasFactory<\Database\Factories\SellerShippingMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'is_enabled',
        'shipping_cost',
        'estimated_delivery_time',
    ];

    public function method(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}

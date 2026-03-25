<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingMethod extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'estimated_days',
        'is_active',
    ];

    public function sellerShippingMethods(): HasMany
    {
        return $this->hasMany(SellerShippingMethod::class);
    }
}

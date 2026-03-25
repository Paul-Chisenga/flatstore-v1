<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingAddress extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'is_default',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }

    public function subOrders(): HasMany
    {
        return $this->hasMany(SubOrder::class);
    }
}

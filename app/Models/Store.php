<?php

namespace App\Models;

use App\Traits\HasAddress;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasAddress;

    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = ['name', 'logo_path', 'email', 'phone', 'seller_id'];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function shippingMethods(): HasMany
    {
        return $this->hasMany(SellerShippingMethod::class);
    }
}

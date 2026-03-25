<?php

namespace App\Models;

use App\Enums\OrderFufillmentType;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubOrder extends Model
{
    /** @use HasFactory<\Database\Factories\SubOrderFactory> */
    use HasFactory;

    protected $fillable = [
        'status',
        'fulfillment_type',
        'seller_shipping_method_id',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'fulfillment_type' => OrderFufillmentType::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function payout(): HasMany
    {
        return $this->hasMany(Payout::class);
    }
}

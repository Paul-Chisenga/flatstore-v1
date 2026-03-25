<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    /** @use HasFactory<\Database\Factories\ShipmentItemFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}

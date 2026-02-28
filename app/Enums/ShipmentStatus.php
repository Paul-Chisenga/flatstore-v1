<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum ShipmentStatus: string
{
    use HasEnumValues;

    // Merchant has the order and is packing it. “Pending”, “Processing”, “Label created”
    case PENDING = 'pending';
    // Package has left seller/warehouse and is in the courier’s custody. “Shipped”, “Dispatched”, “Picked up”
    case SHIPPED = 'shipped';
    // Carrier is moving it through their network toward the destination. “In transit”, “Out for delivery”, “En route”
    case IN_TRANSIT = 'in_transit';
    // Customer has received the parcel. “Delivered”, “Completed”
    case DELIVERED = 'delivered';
    // Something went wrong or the customer returned the item. “Delivery failed”, “Returned to sender”, “Cancelled”
    case RETURNED = 'returned';
}

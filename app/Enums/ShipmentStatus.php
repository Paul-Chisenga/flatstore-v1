<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum ShipmentStatus: string
{
    use HasEnumValues;
    case PENDING = 'pending';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';
}

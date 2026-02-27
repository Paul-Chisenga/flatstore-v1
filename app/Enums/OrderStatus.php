<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum OrderStatus: string
{
    use HasEnumValues;

    case PENDING = "pending";
    case PAID = "paid";
    case SHIPPED = "shipped";
    case DELIVERED = "delivered";
    case CANCELED = "canceled";
    case REFUND_REQUESTED = "refund_requested";
    case CANCELED_REFUND = "canceled_requested";
    case REFUNDED = "refunded";

}

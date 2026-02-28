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
    case REFUND_DECLINED = "refund_request_declined";
    case REFUND_APPROVED = "refund_approved";
    case REFUNDED = "refunded";
}

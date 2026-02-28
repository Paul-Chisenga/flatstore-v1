<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum PaymentStatus: string
{
    use HasEnumValues;

    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}

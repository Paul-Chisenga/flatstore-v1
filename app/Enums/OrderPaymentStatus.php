<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum OrderPaymentStatus: string
{
    use HasEnumValues;

    case PENDING = 'pending';
    case PAID = 'paid';
}

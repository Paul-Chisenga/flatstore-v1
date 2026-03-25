<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum PaymentMethodProvider: string
{
    use HasEnumValues;
    case MOMO = 'mtn_momo';
    case PAYPAL = 'paypal';
}

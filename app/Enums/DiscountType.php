<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum DiscountType: string
{
    use HasEnumValues;
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}

<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum ShippingMethodName : string
{
    use HasEnumValues;
    
    case STANDARD = 'Standard';
    case EXPRESS = 'Express';
}

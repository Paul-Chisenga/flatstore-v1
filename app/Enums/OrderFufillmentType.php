<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum OrderFufillmentType: string
{
    use HasEnumValues;

    case PLATFORM = 'platform';
    case MERCHANT = 'merchant';
    case THIRD_PARTY = 'third_party';
}

<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum SellerType: string
{
    use HasEnumValues;

    case Individual = 'individual';
    case Store = 'store';
}

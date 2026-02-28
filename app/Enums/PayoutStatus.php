<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum PayoutStatus: string
{
    use HasEnumValues;
    case PENDING = "pending";
    case SCHEDULED = "scheduled";
    case PAID = "paid";
    case FAILED = "failed";
}
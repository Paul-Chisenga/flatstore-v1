<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum OrderStatus: string
{
    use HasEnumValues;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case CANCELED = "canceled";
    case COMPLETED = "completed";
}

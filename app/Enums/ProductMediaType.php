<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum ProductMediaType: string
{
    use HasEnumValues;

    case IMAGE = 'image';
    case VIDEO = 'video';
    case THUMBNAIL = 'thumbnail';
}


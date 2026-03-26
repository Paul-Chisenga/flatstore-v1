<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum SocialProvider: string
{
    use HasEnumValues;
    case GOOGLE = 'google';
}

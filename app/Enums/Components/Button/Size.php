<?php

namespace App\Enums\Components\Button;

use App\Traits\HasEnumValues;

enum Size: string
{
    use HasEnumValues;

    case Default = 'default';
    case Icon = 'icon';
    case Small = 'small';
}

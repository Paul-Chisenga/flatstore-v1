<?php

namespace App\Enums\Components\Button;

use App\Traits\HasEnumValues;

enum Size: string
{
    use HasEnumValues;

    case Default = 'default';
    case Sm = 'sm';
    case Xs = 'xs';
    case Icon = 'icon';
    case IconSm = 'icon-sm';
    case IconXs = 'icon-xs';
}

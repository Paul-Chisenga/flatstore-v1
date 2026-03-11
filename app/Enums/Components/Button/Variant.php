<?php

namespace App\Enums\Components\Button;

use App\Traits\HasEnumValues;

enum Variant: string
{
    use HasEnumValues;

    case Default = 'default';
    case Outline = 'outline';
    case Ghost = 'ghost';
    case Link = 'link';
}

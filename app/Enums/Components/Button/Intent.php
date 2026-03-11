<?php

namespace App\Enums\Components\Button;

use App\Traits\HasEnumValues;

enum Intent: string
{
    use HasEnumValues;

    case Primary = 'primary';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
    case Info = 'info';
    case Secondary = 'secondary';
    case Muted = 'muted';
}

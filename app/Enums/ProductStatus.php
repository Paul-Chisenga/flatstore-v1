<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum ProductStatus: string
{
    use HasEnumValues;

    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
        };
    }
}

<?php

namespace App\Traits;

/**
 * @mixin \BackedEnum
 */
trait HasEnumValues
{
    public static function values(): array
    {
        return array_map(fn (self $e) => $e->value, self::cases());
    }
}

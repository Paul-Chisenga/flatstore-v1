<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum SellerRole: string
{
    use HasEnumValues;

    case Owner = 'owner';
    case Manager = 'manager';
    case Staff = 'staff';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Owner',
            self::Manager => 'Manager',
            self::Staff => 'Staff',
        };
    }
}

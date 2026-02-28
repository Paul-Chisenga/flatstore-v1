<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum UserRole: string
{
    use HasEnumValues;

    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Buyer = 'buyer';
    case Seller = 'seller';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Administrator',
            self::Buyer => 'Buyer',
            self::Seller => 'Seller',
        };
    }

}

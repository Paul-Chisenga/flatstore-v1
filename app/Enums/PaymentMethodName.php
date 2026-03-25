<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum PaymentMethodName: string
{
    use HasEnumValues;

    case BANK = 'bank_transfer';
    case MOBILE_MONEY = 'mobile_money';
    case PAYPAL = 'paypal';

    public function label(): string
    {
        return match ($this) {
            self::BANK => 'Bank Transfer',
            self::MOBILE_MONEY => 'Mobile Money',
            self::PAYPAL => 'PayPal',
        };
    }
}

<?php

namespace App\Models;

use App\Enums\PaymentMethodName;
use App\Enums\PaymentMethodProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'provider',
    ];

    protected $casts = [
        'name' => PaymentMethodName::class,
        'provider' => PaymentMethodProvider::class,
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

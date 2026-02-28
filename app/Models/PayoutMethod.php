<?php

namespace App\Models;

use App\Enums\PayoutMethodName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayoutMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PayoutMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => PayoutMethodName::class,
    ];

    public function payout(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function sellerPayoutMethods()
    {
        return $this->hasMany(SellerPayoutMethod::class);
    }
}

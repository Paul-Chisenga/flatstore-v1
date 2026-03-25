<?php

namespace App\Models;

use App\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    /** @use HasFactory<\Database\Factories\PayoutFactory> */
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'status',
        'transaction_reference',
    ];

    protected $casts = [
        'status' => PayoutStatus::class,
    ];

    public function subOrder(): BelongsTo
    {
        return $this->belongsTo(SubOrder::class);
    }

    public function payoutMethod(): BelongsTo
    {
        return $this->belongsTo(PayoutMethod::class);
    }
}

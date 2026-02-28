<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPayoutMethod extends Model
{
    /** @use HasFactory<\Database\Factories\SellerPayoutMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'account_details',
        'is_active',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function payoutMethod()
    {
        return $this->belongsTo(PayoutMethod::class);
    }
}

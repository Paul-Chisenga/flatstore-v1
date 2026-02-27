<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'street_address',
        'city',
        'state',
        'postal_code',
        // 'country',
        'phone_number',
        'is_default'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}

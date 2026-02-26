<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name'];

    function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}

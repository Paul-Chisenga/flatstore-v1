<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentViewedProduct extends Model
{
    protected $table = 'recent_viewed_products';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

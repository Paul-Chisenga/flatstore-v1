<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = ['name', 'description'];

    public function logo(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

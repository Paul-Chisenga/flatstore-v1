<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    /**
     * The table associated with the model.
     *
     * The migration creates `product_tag` (singular), so we must
     * override the default pluralization that would look for
     * `product_tags`.
     */
    protected $table = 'product_tag';

    /** @use HasFactory<\Database\Factories\ProductTagFactory> */
    use HasFactory;
}

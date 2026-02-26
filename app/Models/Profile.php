<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;


    protected $fillable = [
        "name",
        "email",
        "first_name",
        "last_name",
        "phone",
        "birth_date"
    ];

    public function profilePhoto(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

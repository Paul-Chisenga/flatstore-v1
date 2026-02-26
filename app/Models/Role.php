<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\RoleName;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = ['name' => RoleName::class];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

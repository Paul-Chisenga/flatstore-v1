<?php

namespace App\Traits;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasSlug
{
    protected static function bootHasSlug()
    {
        // Generate slug after the model is created (so it has a primary key)
        static::created(function (Model $model): void {
            $model->slugs()->create([
                'slug' => static::generateUniqueSlug($model, $model->name),
                'is_current' => true,
            ]);
        });

        // Update slug after the model has been updated (name persisted)
        static::updated(function (Model $model): void {
            if ($model->wasChanged('name')) {
                // Mark old slug as not current
                $model->currentSlug()->update(['is_current' => false]);

                // Insert new slug
                $model->slugs()->create([
                    'slug' => static::generateUniqueSlug($model, $model->name),
                    'is_current' => true,
                ]);
            }
        });
    }

    /**
     * Generate a unique slug for the model based on the given name.
     *
     * @param  Model  $model  The model instance for which the slug is being generated.
     * @param  string  $name  The name from which to generate the slug.
     * @return string The generated unique slug.
     */
    protected static function generateUniqueSlug($model, string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $i = 1;
        while (Slug::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$i++;
        }

        return $slug;
    }

    // Define relationships
    public function slugs(): MorphMany
    {
        return $this->morphMany(Slug::class, 'sluggable');
    }

    // Get the current slug
    public function currentSlug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable')->where('is_current', true);
    }
}

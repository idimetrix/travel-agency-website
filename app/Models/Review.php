<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'name',
        'avatar_id',
        'date',
        'body',
        'rating',
        'link',
        'icon_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function avatar()
    {
        return $this->belongsTo(Image::class, 'avatar_id');
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'entity', 'entity_image');
    }

    public function icon()
    {
        return $this->belongsTo(Image::class, 'icon_id');
    }

    /**
     * @param array|null $relations
     * @return self
     */
    public function syncRelations(?array $relations): self
    {
        if (\is_array($relations)) {
            if (array_key_exists('images', $relations)) {
                $this->images()->sync($relations['images']);
            }
        }

        return $this;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'date']
            ]
        ];
    }
}

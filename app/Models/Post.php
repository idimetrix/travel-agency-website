<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'category_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'title',
        'short_description',
        'description',
        'main_image_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $attributes = [
        'rating' => 0
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mainImage()
    {
        return $this->belongsTo(Image::class, 'main_image_id');
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'entity', 'entity_image');
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
                'source' => 'title'
            ]
        ];
    }
}

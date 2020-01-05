<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'meta_title',
        'meta_keywords',
        'meta_description',
        'country',
        'city',
        'hotel',
        'duration',
        'tourists_number',
        'departure_date',
        'food',
        'note',
        'main_image_id',
        'description',
        'price',
        'is_hot'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function mainImage()
    {
        return $this->belongsTo(Image::class, 'main_image_id');
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'entity', 'entity_image');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = round($value, 2);
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
                'source' => ['country', 'city']
            ]
        ];
    }
}

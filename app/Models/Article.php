<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Article extends Model
{
    use Sluggable, SluggableScopeHelpers;

    public const AVAILABLE_TYPES = [
        'country',
        'direction'
    ];

    protected $fillable = [
        'meta_title',
        'meta_keywords',
        'meta_description',
        'main_image_id',
        'title',
        'short_description',
        'description',
        'type'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['type'];

    public function setTypeAttribute($value)
    {
        if (!\in_array($value, self::AVAILABLE_TYPES, true)) {
            throw new \Exception('Invalid article type');
        }

        $this->attributes['type'] = $value;
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

    public function scopeFilter(Builder $query, Request $request)
    {
        if ($request->has('type')) {
            $query->where('type', $request->get('type'));
        }

        return $query;
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
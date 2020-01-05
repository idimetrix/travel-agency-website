<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    const UNKNOWN_TYPE = 'unknown';
    const ICON_TYPE = 'icon';

    const TYPES = [
        self::UNKNOWN_TYPE,
        self::ICON_TYPE
    ];

    const DEFAULT_TYPE = self::UNKNOWN_TYPE;

    protected $fillable = [
        'path',
        'type'
    ];

    protected $attributes = [
        'type' => self::DEFAULT_TYPE
    ];

    protected $appends = [
        'url'
    ];

    protected $hidden = [
        'path'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function setTypeAttribute($type)
    {
        if (!in_array($type, self::TYPES, true)) {
            throw new \Exception('Invalid image type');
        }

        $this->attributes['type'] = $type;
    }

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->path);
    }

    public function tours()
    {
        return $this->morphedByMany(Tour::class, 'entity', 'entity_image');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'entity', 'entity_image');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        return $query;
    }
}

<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\BaseIndexRequest;
use App\Models\Image;

class IndexImageRequest extends BaseIndexRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'filter' => 'array',
            'filter.type' => 'string|in:' . implode(',', Image::TYPES)
        ]);
    }
}

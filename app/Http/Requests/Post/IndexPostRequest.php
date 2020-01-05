<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseIndexRequest;

class IndexPostRequest extends BaseIndexRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

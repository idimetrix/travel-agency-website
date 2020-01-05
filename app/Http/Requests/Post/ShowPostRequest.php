<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseShowRequest;

class ShowPostRequest extends BaseShowRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseShowRequest;

class ShowArticleRequest extends BaseShowRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

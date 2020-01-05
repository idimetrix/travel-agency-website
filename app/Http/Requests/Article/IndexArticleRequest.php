<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseIndexRequest;

class IndexArticleRequest extends BaseIndexRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\BaseIndexRequest;

class IndexTourRequest extends BaseIndexRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

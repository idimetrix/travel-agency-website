<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseIndexRequest;

class IndexReviewRequest extends BaseIndexRequest
{
    protected $authorizedWith = [
        'avatar',
        'images'
    ];
}

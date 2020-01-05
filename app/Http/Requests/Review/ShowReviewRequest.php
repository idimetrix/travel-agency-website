<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseShowRequest;

class ShowReviewRequest extends BaseShowRequest
{
    protected $authorizedWith = [
        'avatar',
        'images'
    ];
}

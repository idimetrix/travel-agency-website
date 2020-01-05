<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\BaseShowRequest;

class ShowTourRequest extends BaseShowRequest
{
    protected $authorizedWith = [
        'mainImage',
        'images'
    ];
}

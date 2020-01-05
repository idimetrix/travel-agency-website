<?php

namespace App\Http\Requests\Traits;

trait AuthorizeTrue
{
    public function authorize()
    {
        return true;
    }
}
<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AuthorizeTrue;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseStoreRequest extends FormRequest
{
    use AuthorizeTrue;

    public function rules()
    {
        return [];
    }
}
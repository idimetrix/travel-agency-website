<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AuthorizeTrue;
use Illuminate\Foundation\Http\FormRequest;

class ResultWheelOfFortuneRequest extends FormRequest
{
    use AuthorizeTrue;

    public function rules()
    {
        return [
            'email' => 'required|string',
            'name' => 'required|string',
            'discount' => 'required|string'
        ];
    }
}

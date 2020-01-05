<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AuthorizeTrue;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use AuthorizeTrue;

    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required'
        ];
    }
}
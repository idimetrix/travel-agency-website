<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AuthorizeTrue;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeToNewsletterRequest extends FormRequest
{
    use AuthorizeTrue;

    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|string|max:255'
        ];
    }
}

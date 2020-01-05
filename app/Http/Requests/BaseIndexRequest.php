<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AuthorizeTrue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class BaseIndexRequest extends FormRequest
{
    use AuthorizeTrue;

    /** @var array */
    protected $authorizedWith = [];

    public function rules()
    {
        return array_merge(
            $this->getWithRules()
        );
    }

    protected function getWithRules(): array
    {
        return [
            'with' => 'array',
            'with.*' => [
                'string',
                Rule::in($this->authorizedWith)
            ]
        ];
    }
}
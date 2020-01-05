<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseUpdateRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\RequestBody(
 *   request="UpdateCategoryRequest",
 *   description="Update Category Request",
 *   required=true,
 *   @OA\JsonContent(
 *     @OA\Property(
 *       property="name",
 *       type="string",
 *       maxLength=255
 *     ),
 *     required={
 *       "name"
 *     }
 *   )
 * )
 */
class UpdateCategoryRequest extends BaseUpdateRequest
{
    public function rules()
    {
        return [
            'name' => [
                'string',
                Rule::unique('categories')->ignore($this->category->id)
            ]
        ];
    }
}

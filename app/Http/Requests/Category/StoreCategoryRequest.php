<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseStoreRequest;

/**
 * @OA\RequestBody(
 *   request="StoreCategoryRequest",
 *   description="Store Category Request",
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
class StoreCategoryRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|unique:categories,name'
        ];
    }
}

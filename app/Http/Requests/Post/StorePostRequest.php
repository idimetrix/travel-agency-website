<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseStoreRequest;

/**
 * @OA\RequestBody(
 *   request="StorePostRequest",
 *   description="Store Post Request",
 *   required=true,
 *   @OA\JsonContent(
 *     @OA\Property(
 *       property="category_id",
 *       type="integer"
 *     ),
 *     @OA\Property(
 *       property="meta_title",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="meta_keywords",
 *       type="string",
 *       maxLength=1000
 *     ),
 *     @OA\Property(
 *       property="meta_description",
 *       type="string",
 *       maxLength=1000
 *     ),
 *     @OA\Property(
 *       property="main_image_id",
 *       type="integer"
 *     ),
 *     @OA\Property(
 *       property="title",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="short_description",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="relations",
 *       type="object",
 *       @OA\Property(
 *         property="images",
 *         type="array",
 *         @OA\Items(
 *           type="integer"
 *         )
 *       )
 *     ),
 *     required={
 *       "title",
 *       "short_description",
 *       "description",
 *       "main_image_id"
 *     }
 *   )
 * )
 */
class StorePostRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'category_id' => 'nullable|integer|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:1000',
            'meta_description' => 'nullable|string|max:1000',
            'main_image_id' => 'required|integer|exists:images,id',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',

            'relations.images' => 'array',
            'relations.images.*' => 'required|integer|exists:images,id',
        ];
    }
}

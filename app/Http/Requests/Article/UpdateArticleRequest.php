<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseUpdateRequest;
use App\Models\Article;
use Illuminate\Validation\Rule;

/**
 * @OA\RequestBody(
 *   request="UpdateArticleRequest",
 *   description="Update Article Request",
 *   required=true,
 *   @OA\JsonContent(
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
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="type",
 *       type="string",
 *       enum={"country", "direction"}
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
 *     )
 *   )
 * )
 */
class UpdateArticleRequest extends BaseUpdateRequest
{
    public function rules()
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:1000',
            'meta_description' => 'nullable|string|max:1000',
            'main_image_id' => 'integer|exists:images,id',
            'title' => 'string|max:255',
            'short_description' => 'string',
            'description' => 'string',
            'type' => [
                'string',
                Rule::in(Article::AVAILABLE_TYPES)
            ],

            'relations.images' => 'array',
            'relations.images.*' => 'required|integer|exists:images,id',
        ];
    }
}

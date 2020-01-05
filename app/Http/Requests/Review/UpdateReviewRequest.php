<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseUpdateRequest;

/**
 * @OA\RequestBody(
 *   request="UpdateReviewRequest",
 *   description="Update Review Request",
 *   required=true,
 *   @OA\JsonContent(
 *     @OA\Property(
 *       property="avatar_id",
 *       type="integer"
 *     ),
 *     @OA\Property(
 *       property="name",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="date",
 *       type="string",
 *       format="date"
 *     ),
 *     @OA\Property(
 *       property="body",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="rating",
 *       type="integer",
 *       minimum=0,
 *       maximum=5
 *     ),
 *     @OA\Property(
 *       property="link",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="icon_id",
 *       type="integer"
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
class UpdateReviewRequest extends BaseUpdateRequest
{
    public function rules()
    {
        return [
            'avatar_id' => 'integer|exists:images,id',
            'name' => 'string|max:255',
            'date' => 'date',
            'body' => 'string',
            'rating' => 'integer|between:0,5',
            'link' => 'nullable|string|max:2000',
            'icon_id' => 'nullable|integer|exists:images,id',

            'relations.images' => 'array',
            'relations.images.*' => 'required|integer|exists:images,id',
        ];
    }
}

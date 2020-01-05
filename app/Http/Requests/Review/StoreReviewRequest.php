<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseStoreRequest;

/**
 * @OA\RequestBody(
 *   request="StoreReviewRequest",
 *   description="Store Review Request",
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
 *     ),
 *     required={
 *       "avatar_id",
 *       "name",
 *       "date",
 *       "body",
 *       "rating"
 *     }
 *   )
 * )
 */
class StoreReviewRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'avatar_id' => 'required|integer|exists:images,id',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'body' => 'required|string',
            'rating' => 'required|integer|between:0,5',
            'link' => 'nullable|string|max:2000',
            'icon_id' => 'nullable|integer|exists:images,id',

            'relations.images' => 'array',
            'relations.images.*' => 'required|integer|exists:images,id',
        ];
    }
}

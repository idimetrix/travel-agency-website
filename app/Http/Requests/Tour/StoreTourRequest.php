<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\BaseStoreRequest;

/**
 * @OA\RequestBody(
 *   request="StoreTourRequest",
 *   description="Store Tour Request",
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
 *       property="country",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="city",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="hotel",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="duration",
 *       type="integer",
 *       maximum=255
 *     ),
 *     @OA\Property(
 *       property="tourists_number",
 *       type="integer",
 *       maximum=255
 *     ),
 *     @OA\Property(
 *       property="departure_date",
 *       type="string",
 *       format="date"
 *     ),
 *     @OA\Property(
 *       property="food",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="note",
 *       type="string",
 *       maxLength=255
 *     ),
 *     @OA\Property(
 *       property="main_image_id",
 *       type="integer"
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="price",
 *       type="number",
 *       format="float"
 *     ),
 *     @OA\Property(
 *       property="is_hot",
 *       type="boolean"
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
 *       "country",
 *       "city",
 *       "duration",
 *       "tourists_number",
 *       "departure_date",
 *       "food",
 *       "note",
 *       "main_image_id",
 *       "description",
 *       "price",
 *       "is_hot"
 *     }
 *   )
 * )
 */
class StoreTourRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:1000',
            'meta_description' => 'nullable|string|max:1000',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'hotel' => 'nullable|string|max:255',
            'duration' => 'required|integer|min:1|max:255',
            'tourists_number' => 'required|integer|min:1|max:255',
            'departure_date' => 'required|date',
            'food' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'main_image_id' => 'required|integer|exists:images,id',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'is_hot' => 'required|boolean',

            'relations.images' => 'array',
            'relations.images.*' => 'required|integer|exists:images,id',
        ];
    }
}

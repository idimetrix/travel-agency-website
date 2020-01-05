<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\BaseStoreRequest;
use App\Models\Image;

/**
 * @OA\RequestBody(
 *   request="StoreImagesRequest",
 *   description="Store Images Request",
 *   required=true,
 *   @OA\MediaType(
 *     mediaType="multipart/form-data",
 *     @OA\Schema(
 *       type="object",
 *       @OA\Property(
 *         description="В документации не работает массовая загрузка файлов",
 *         property="images",
 *         type="array",
 *         @OA\Items(
 *           type="string",
 *           format="binary"
 *         )
 *       ),
 *       @OA\Property(
 *         property="width",
 *         type="integer",
 *         minimum=100,
 *         maximum=1920
 *       ),
 *       @OA\Property(
 *         property="height",
 *         type="integer",
 *         minimum=100,
 *         maximum=1920
 *       ),
 *       @OA\Property(
 *         property="type",
 *         type="string",
 *         default="unknown",
 *         enum={"unknown", "icon"}
 *       )
 *     )
 *   )
 * )
 */
class StoreImagesRequest extends BaseStoreRequest
{
    public function rules()
    {
        return [
            'images' => 'array',
            'images.*' => 'required|image',
            'width' => 'required_with:height|integer|min:10|max:1920',
            'height' => 'required_with:width|integer|min:10|max:1920',
            'type' => 'string|in:' . implode(',', Image::TYPES)
        ];
    }
}

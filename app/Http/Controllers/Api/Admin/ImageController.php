<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\IndexImageRequest;
use App\Http\Requests\Image\StoreImagesRequest;
use App\Jobs\UploadImages;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Images"},
     *   path="/images",
     *   @OA\Parameter(
     *     name="filter[type]",
     *     in="query",
     *     description="Filter by image type",
     *     @OA\Schema(
     *       type="string",
     *       enum={"unknown", "icon"}
     *     )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="LIST",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function index(IndexImageRequest $request)
    {
        return Image::query()->filter($request->get('filter', []))->get();
    }
    
    /**
     * @OA\Post(
     *   tags={"Images"},
     *   path="/images",
     *   requestBody={"$ref": "#/components/requestBodies/StoreImagesRequest"},
     *   @OA\Response(
     *     response=200,
     *     description="LIST",
     *     @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StoreImagesRequest $request)
    {
        return dispatch_now(new UploadImages(
            $request->images,
            $request->width,
            $request->height,
            $request->get('type', Image::DEFAULT_TYPE)
        ));
    }

    /**
     * @OA\Delete(
     *   tags={"Images"},
     *   path="/images/{image_id}",
     *   @OA\Parameter(
     *     name="image_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *       response=204,
     *       description="NO CONTENT",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json(null, 204);
    }
}

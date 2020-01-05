<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\IndexReviewRequest;
use App\Http\Requests\Review\ShowReviewRequest;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Reviews"},
     *   path="/reviews",
     *   @OA\Parameter(
     *     name="with[]",
     *     in="query",
     *     description="With relations",
     *     explode=true,
     *     @OA\Schema(
     *       type="array",
     *       @OA\Items(
     *         type="string",
     *         enum = {"avatar", "images"}
     *       )
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
    public function index(IndexReviewRequest $request)
    {
        return get_or_paginate(
            Review::query()->with($request->get('with', []))->orderBy('id', 'desc')
        );
    }

    /**
     * @OA\Post(
     *   tags={"Reviews"},
     *   path="/reviews",
     *   requestBody={"$ref": "#/components/requestBodies/StoreReviewRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StoreReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Review $review */
            $review = Review::query()->create($request->validated());
            $review->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $review->load(['avatar', 'images', 'icon']);
    }

    /**
     * @OA\Get(
     *   tags={"Reviews"},
     *   path="/reviews/{review_id}",
     *   @OA\Parameter(
     *     name="review_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="with[]",
     *     in="query",
     *     description="With relations",
     *     explode=true,
     *     @OA\Schema(
     *       type="array",
     *       @OA\Items(
     *         type="string",
     *         enum = {"avatar", "images"}
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function show(ShowReviewRequest $request, Review $review)
    {
        return $review->load($request->get('with', []));
    }

    /**
     * @OA\Put(
     *   tags={"Reviews"},
     *   path="/reviews/{review_id}",
     *   @OA\Parameter(
     *     name="review_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   requestBody={"$ref": "#/components/requestBodies/UpdateReviewRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        DB::beginTransaction();
        try {
            $review->update($request->validated());
            $review->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $review->load(['avatar', 'images']);
    }

    /**
     * @OA\Delete(
     *   tags={"Reviews"},
     *   path="/reviews/{review_id}",
     *   @OA\Parameter(
     *     name="review_id",
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
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json(null, 204);
    }
}

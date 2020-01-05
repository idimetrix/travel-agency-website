<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\IndexTourRequest;
use App\Http\Requests\Tour\ShowTourRequest;
use App\Http\Requests\Tour\StoreTourRequest;
use App\Http\Requests\Tour\UpdateTourRequest;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Tours"},
     *   path="/tours",
     *   @OA\Parameter(
     *     name="with[]",
     *     in="query",
     *     description="With relations",
     *     explode=true,
     *     @OA\Schema(
     *       type="array",
     *       @OA\Items(
     *         type="string",
     *         enum = {"mainImage", "images"}
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
    public function index(IndexTourRequest $request)
    {
        return get_or_paginate(
            Tour::query()->with($request->get('with', []))->orderBy('id', 'desc')
        );
    }

    /**
     * @OA\Post(
     *   tags={"Tours"},
     *   path="/tours",
     *   requestBody={"$ref": "#/components/requestBodies/StoreTourRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StoreTourRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Tour $tour */
            $tour = Tour::query()->create($request->validated());
            $tour->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $tour->load(['mainImage', 'images']);
    }

    /**
     * @OA\Get(
     *   tags={"Tours"},
     *   path="/tours/{tour_id}",
     *   @OA\Parameter(
     *     name="tour_id",
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
     *         enum = {"mainImage", "images"}
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
    public function show(ShowTourRequest $request, Tour $tour)
    {
        return $tour->load($request->get('with', []));
    }

    /**
     * @OA\Put(
     *   tags={"Tours"},
     *   path="/tours/{tour_id}",
     *   @OA\Parameter(
     *     name="tour_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   requestBody={"$ref": "#/components/requestBodies/UpdateTourRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        DB::beginTransaction();
        try {
            $tour->update($request->validated());
            $tour->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $tour->load(['mainImage', 'images']);
    }

    /**
     * @OA\Delete(
     *   tags={"Tours"},
     *   path="/tours/{tour_id}",
     *   @OA\Parameter(
     *     name="tour_id",
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
    public function destroy(Tour $tour)
    {
        $tour->delete();

        return response()->json(null, 204);
    }
}

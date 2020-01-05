<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController
{
    /**
     * @OA\Get(
     *   tags={"Categories"},
     *   path="/categories",
     *   @OA\Response(
     *       response=200,
     *       description="LIST",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function index()
    {
        return get_or_paginate(Category::query()->orderBy('id', 'desc'));
    }

    /**
     * @OA\Post(
     *   tags={"Categories"},
     *   path="/categories",
     *   requestBody={"$ref": "#/components/requestBodies/StoreCategoryRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StoreCategoryRequest $request)
    {
        return Category::query()->create($request->validated());
    }

    /**
     * @OA\Get(
     *   tags={"Categories"},
     *   path="/categories/{category_id}",
     *   @OA\Parameter(
     *     name="category_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
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
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * @OA\Put(
     *   tags={"Categories"},
     *   path="/categories/{category_id}",
     *   @OA\Parameter(
     *     name="category_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   requestBody={"$ref": "#/components/requestBodies/UpdateCategoryRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $category;
    }

    /**
     * @OA\Delete(
     *   tags={"Categories"},
     *   path="/categories/{category_id}",
     *   @OA\Parameter(
     *     name="category_id",
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
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
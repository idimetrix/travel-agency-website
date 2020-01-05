<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Post\ShowPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Posts"},
     *   path="/posts",
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
    public function index(IndexPostRequest $request)
    {
        return get_or_paginate(
            Post::query()->with($request->get('with', []))->orderBy('id', 'desc')
        );
    }

    /**
     * @OA\Post(
     *   tags={"Posts"},
     *   path="/posts",
     *   requestBody={"$ref": "#/components/requestBodies/StorePostRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Post $post */
            $post = Post::query()->create($request->validated());
            $post->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $post->load(['mainImage', 'images']);
    }

    /**
     * @OA\Get(
     *   tags={"Posts"},
     *   path="/posts/{post_id}",
     *   @OA\Parameter(
     *     name="post_id",
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
    public function show(ShowPostRequest $request, Post $post)
    {
        return $post->load($request->get('with', []));
    }

    /**
     * @OA\Put(
     *   tags={"Posts"},
     *   path="/posts/{post_id}",
     *   @OA\Parameter(
     *     name="post_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   requestBody={"$ref": "#/components/requestBodies/UpdatePostRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        DB::beginTransaction();
        try {
            $post->update($request->validated());
            $post->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $post->load(['mainImage', 'images']);
    }

    /**
     * @OA\Delete(
     *   tags={"Posts"},
     *   path="/posts/{post_id}",
     *   @OA\Parameter(
     *     name="post_id",
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
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}

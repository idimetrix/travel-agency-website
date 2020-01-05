<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\IndexArticleRequest;
use App\Http\Requests\Article\ShowArticleRequest;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Articles"},
     *   path="/articles",
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
    public function index(IndexArticleRequest $request)
    {
        return get_or_paginate(
            Article::query()->filter($request)->with($request->get('with', []))->orderBy('id', 'desc')
        );
    }

    /**
     * @OA\Post(
     *   tags={"Articles"},
     *   path="/articles",
     *   requestBody={"$ref": "#/components/requestBodies/StoreArticleRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function store(StoreArticleRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Article $article */
            $article = Article::query()->create($request->validated());
            $article->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $article->load(['mainImage', 'images']);
    }

    /**
     * @OA\Get(
     *   tags={"Articles"},
     *   path="/articles/{article_id}",
     *   @OA\Parameter(
     *     name="article_id",
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
    public function show(ShowArticleRequest $request, Article $article)
    {
        return $article->load($request->get('with', []));
    }

    /**
     * @OA\Put(
     *   tags={"Articles"},
     *   path="/articles/{article_id}",
     *   @OA\Parameter(
     *     name="article_id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   requestBody={"$ref": "#/components/requestBodies/UpdateArticleRequest"},
     *   @OA\Response(
     *       response=200,
     *       description="ITEM",
     *       @OA\JsonContent()
     *   ),
     *   security={{"bearer":{}}}
     * )
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        DB::beginTransaction();
        try {
            $article->update($request->validated());
            $article->syncRelations($request->get('relations'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $article->load(['mainImage', 'images']);
    }

    /**
     * @OA\Delete(
     *   tags={"Articles"},
     *   path="/articles/{article_id}",
     *   @OA\Parameter(
     *     name="article_id",
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
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}

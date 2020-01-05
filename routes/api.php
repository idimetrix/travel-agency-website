<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {

    Route::group(['namespace' => 'Admin'], function () {
        Route::group(['namespace' => 'Auth'], function () {
            Route::post('login', 'LoginController@login');
        });

        Route::group(['middleware' => 'auth:api'], function () {
            Route::apiResource('images', 'ImageController', ['only' => ['index', 'store', 'destroy']]);
            Route::apiResource('tours', 'TourController');
            Route::apiResource('categories', 'CategoryController');
            Route::apiResource('posts', 'PostController');
            Route::apiResource('reviews', 'ReviewController');
            Route::apiResource('articles', 'ArticleController');
        });
    });

});
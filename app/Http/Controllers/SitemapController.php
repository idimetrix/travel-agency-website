<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Post;
use App\Models\Review;
use App\Models\Tour;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $tours = Tour::query()->get();
        $countries = Article::query()->where('type', 'country')->get();
        $destinations = Article::query()->where('type', 'direction')->get();
        $posts = Post::query()->get();
        $reviews = Review::query()->get();

        return view('sitemap', [
            'tours' => $tours,
            'countries' => $countries,
            'destinations' => $destinations,
            'posts' => $posts,
            'reviews' => $reviews
        ]);
    }
}

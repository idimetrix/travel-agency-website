<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->with('mainImage')->paginate(9);

        return view('blog-page', ['posts' => $posts]);
    }

    public function show(string $slug)
    {
        $post = Post::query()->whereSlug($slug)->with(['mainImage', 'images'])->firstOrFail();

        return view('post-example', ['post' => $post]);
    }
}

<?php

namespace App\Composers;

use App\Models\Post;
use Illuminate\View\View;

class PostsComposer
{
    public function compose(View $view)
    {
        $posts = Post::query()->with('mainImage')->get();
        $view->with('posts', $posts);
    }
}
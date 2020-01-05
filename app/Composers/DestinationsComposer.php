<?php

namespace App\Composers;

use App\Models\Article;
use Illuminate\View\View;

class DestinationsComposer
{
    public function compose(View $view)
    {
        $destinations = Article::query()->where('type', 'direction')->with('mainImage')->get();
        $view->with('destinations', $destinations);
    }
}
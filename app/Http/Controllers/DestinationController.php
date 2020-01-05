<?php

namespace App\Http\Controllers;

use App\Models\Article;

class DestinationController extends Controller
{
    public function show(string $slug)
    {
        $destination = Article::query()
            ->whereSlug($slug)
            ->where('type', 'direction')
            ->with(['mainImage', 'images'])
            ->firstOrFail();

        return view('popular-way', ['destination' => $destination]);
    }
}

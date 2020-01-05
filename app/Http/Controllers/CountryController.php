<?php

namespace App\Http\Controllers;

use App\Models\Article;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Article::query()->where('type', 'country')->with(['mainImage'])->get();

        return view('countries-page', ['countries' => $countries]);
    }

    public function show(string $slug)
    {
        $country = Article::query()
            ->whereSlug($slug)
            ->where('type', 'country')
            ->with(['mainImage', 'images'])
            ->firstOrFail();

        return view('country-example', ['country' => $country]);
    }
}

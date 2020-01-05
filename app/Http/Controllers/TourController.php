<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::query()->with(['mainImage', 'images'])->paginate(9);

        return view('tours', ['tours' => $tours]);
    }

    public function show(string $slug)
    {
        $tour = Tour::query()->whereSlug($slug)->with(['mainImage', 'images'])->firstOrFail();

        return view('tour-page', ['tour' => $tour]);
    }
}

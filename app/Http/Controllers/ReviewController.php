<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::query()->with('avatar', 'icon')->paginate(9);

        return view('reviews-page', ['reviews' => $reviews]);
    }
}

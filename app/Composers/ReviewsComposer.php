<?php

namespace App\Composers;

use App\Models\Review;
use Illuminate\View\View;

class ReviewsComposer
{
    public function compose(View $view)
    {
        $reviews = Review::with('avatar', 'icon')->limit(7)->get();
        $view->with('reviews', $reviews);
    }
}

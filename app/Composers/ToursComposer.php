<?php

namespace App\Composers;

use App\Models\Tour;
use Illuminate\View\View;

class ToursComposer
{
    public function compose(View $view)
    {
        $tours = Tour::where('is_hot', true)->with('mainImage')->limit(7)->get();
        $view->with('tours', $tours);
    }
}
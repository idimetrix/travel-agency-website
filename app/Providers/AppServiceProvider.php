<?php

namespace App\Providers;

use App\Composers\DestinationsComposer;
use App\Composers\ReviewsComposer;
use App\Composers\ToursComposer;
use App\Composers\PostsComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.index-page.hot-tours', ToursComposer::class);
        view()->composer('includes.index-page.popular-ways', DestinationsComposer::class);
        view()->composer('includes.index-page.reviews', ReviewsComposer::class);
        view()->composer('includes.index-page.blog', PostsComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

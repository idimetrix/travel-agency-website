<?php

Route::get('/login', function () {
    return view('loginAdmin');
});
Route::get('/dashboard', function (){
    return view('dashboardMain');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/contacts', function () {
    return view('contacts-page');
});
Route::get('/about', function () {
    return view('about-page');
});
Route::get('/tourists', function () {
    return view('tourists');
});
Route::get('/tourists/2', function () {
    return view('tourists-2');
});
Route::get('/tourists/3', function () {
    return view('tourists-3');
});
Route::get('/tourists/4', function () {
    return view('tourists-4');
});
Route::get('/tourists/5', function () {
    return view('tourists-5');
});


Route::get('destinations/{slug}', 'DestinationController@show');

Route::get('countries', 'CountryController@index');
Route::get('countries/{slug}', 'CountryController@show');

Route::get('blog', 'PostController@index');
Route::get('post/{slug}', 'PostController@show');

Route::get('tours', 'TourController@index');
Route::get('tours/{slug}', 'TourController@show');

Route::get('reviews', 'ReviewController@index');

Route::post('consultations', 'ConsultationController@store');
Route::post('newsletter-subscriptions', 'NewsletterSubscriptionController@subscribe');
Route::post('wheel-of-fortune', 'WheelOfFortune@sendResult');

Route::get('sitemap', 'SitemapController@sitemap');

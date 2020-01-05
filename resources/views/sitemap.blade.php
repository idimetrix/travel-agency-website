{{--{{ dd($tours, $countries, $destinations, $posts, $reviews) }}--}}
@extends('layouts.app')
@section('title')
    Карта сайта- Cronix Tour
@endsection
@section('meta-description')
    Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.
@endsection
@section('keywords')
    автобусные туры, туры к морю, отдых на море
@endsection
@section('content')
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-title-wrap">
                        <div class="line-mob"></div>
                        <h2>Карта сайта</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container sitemap-page">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8">
                    <ul class="sitemap-list">
                        <li>
                            <h2>
                                <a href="/">
                                    Главная
                                </a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <a href="/countries">Страны</a>
                            </h2>


                            <ul>
                                @foreach($countries as $country)
                                    <li>
                                        <a href="/countries/{{$country->slug}}">
                                            {{$country->title}}
                                        </a>
                                    </li>
                                    @endforeach
                            </ul>
                        </li>
                        <li>
                            <h2>
                                <a href="/blog">
                                    Блог
                                </a>
                            </h2>

                            <ul>
                                @foreach($posts as $post)
                                    <li>
                                        <a href="/post/{{$post->slug}}">
                                            {{$post->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>

                            <h2>
                                <a href="/tours">
                                    Все туры
                                </a>
                            </h2>

                            <ul>
                                @foreach($tours as $tour)
                                    <li>
                                        <a href="/tours/{{$tour->slug}}">
                                            {{$tour->city}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                           <h2>
                               Направления
                           </h2>
                        <ul>
                            @foreach($destinations as $destination)
                                <li>
                                    <a href="/destinations/{{$destination->slug}}">
                                        {{$destination->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        </li>
                        <li>
                            <h2>
                                <a href="/reviews">
                                    Отзывы клиентов
                                </a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <a href="/contacts">
                                    Контакты
                                </a>
                            </h2>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

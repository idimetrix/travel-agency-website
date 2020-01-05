
@extends('layouts.app')
@section('title')
    Туры- Cronix Tour
@endsection
@section('meta-description')
    Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.
@endsection
@section('keywords')
    автобусные туры, туры к морю, отдых на море
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="Туры - Cronix Tour">
    <meta property="og:description"
          content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta property="og:url" content="{{request()->getHost()}}/tours">
    <meta property="og:site_name" content="Cronix Tour">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta name="twitter:title" content="Туры из России 2018: автобусные туры, туры к морю, отдых на море, горящие туры / Кроникс тур">
@endsection
@section('content')
<section class="blog-page-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>Туры</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="blog-wrap" style="margin-top: 20px">

    <div class="container">

        <div class="row tour-page" style="margin-bottom: 0">
            @foreach($tours as $tour)
                <div class="col-md-6 col-lg-4 hot-tour-item">
                    <a href="/tours/{{$tour->slug}}" class="hot-tour-item">
                        <div class="hot-tour-rating-wrap">
                            <div class="hot-tour-rating-item"
                                 style="background: url('./images/rating-example.png')no-repeat"></div>
                            <span class="count">{{$tour->duration}} дней</span>
                            <span class="del-symb">|</span>
                            <span class="count">{{$tour->tourists_number}} человек</span>
                        </div>
                        <div data-src="{{$tour->mainImage->url}}" class="hot-tour-info lazy position-relative">
                            <div class="black-overlay"></div>
                            <div class="row align-items-center justify-content-between m-0 flex-nowrap position-relative">
                                <div class="flex-1">
                                    <p class="country-name">{{$tour->city}}</p>
                                </div>
                                <div>
                                    <p class="price-count">от {{round($tour->price)}} руб</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="tour-descr">
                                        {{$tour->description}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="learn-more">
                                        Подробнее <span class="for-line"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="load-more-posts">
            {{ $tours->links() }}
        </div>

    </div>

</div>
    @include('includes.index-page.free-consult')
@endsection




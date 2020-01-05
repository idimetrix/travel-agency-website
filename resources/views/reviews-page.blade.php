{{--{{ dd($reviews) }}--}}

@extends('layouts.app')
@section('title')
    Отзывы клиентов- Cronix Tour
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
          content="Отзывы клиентов - Cronix Tour">
    <meta property="og:description"
          content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta property="og:url" content="{{request()->getHost()}}/reviews">
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
                        <h2>Отзывы клиентов</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="blog-wrap reviews-section">

        <div class="container review-page">

            <div class="row">
                @foreach($reviews as $key => $review)
                <div class="col-md-6 col-lg-4 col-xl-4 blog-item-wrap">
                    <a href="{{$review->link}}">
                    <div class="review-card review-card-page" style="height: 500px;">
                        <div class="top-review-block">
                            <img  data-src="{{$review->avatar->url}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="review-img lazy"/>
                            <div class="author-wrap">
                                <p class="review-author" title="{{$review->name}}">
                                    {{$review->name}}
                                </p>
                                {{--<img src="./images/ratingimg.png"/>--}}
                                <select class="review-rating" id="{{$key . 'rating'}}" data-rating="{{$review->rating}}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="author-line"></div>
                        </div>
                        <div class="review-txt">
                            <p>
                                {!! nl2br($review->body) !!}
                            </p>
                        </div>
                        <div class="review-date d-flex justify-content-between align-items-center" style="width: calc(100% - 45px)">
                            <div class="author-line"></div>
                            <p>
                                {{date('d-m-Y', strtotime($review->date))}}
                            </p>
                            <span class="sourse-img">
                                        <a href="{{$review->link}}" target="_blank">
                                          @if(isset($review->icon))
                                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{$review->icon->url}}" alt="" class="lazy">
                                            @endif
                                        </a>
                                    </span>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>


                <div class="load-more-posts">
                    {{ $reviews->links() }}

                </div>


        </div>

    </div>
    @include('includes.index-page.free-consult')
@endsection





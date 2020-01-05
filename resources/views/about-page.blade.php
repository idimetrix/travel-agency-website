{{--{{ dd($tours, $countries, $destinations, $posts, $reviews) }}--}}
@extends('layouts.app')
@section('title')
    МЫ- Cronix Tour
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
                        <h2>Мы</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container sitemap-page single-country-wrap">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2 class="text-center">Про «Кроникс Тур»</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="about-country-wrap" style="margin-top: 0; background: inherit">
                        <div class="for-slider-wrap">

                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/7.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/7.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/8.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/8.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/9.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/9.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/10.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/10.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/11.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/11.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/12.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/12.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/13.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/13.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/14.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/14.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/15.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/15.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/16.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/16.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/17.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/17.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/18.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/18.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/19.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/19.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/20.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/20.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/21.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/21.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/22.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/22.jpg')}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>
                            <div class="slider-item">
                                <a href="{{asset('/images/reviews/23.jpg')}}">
                                    <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                    <img alt="image" class="slider-item-photo lazy"
                                         data-src="{{asset('/images/reviews/23.jpg')}}"
                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="country-example-nav about-page" style="width: 100%;text-align: right;margin-right: 80px;"
                     id="country-example-nav">
                    <img class="r-arrow-review" src="./images/L.png"/>
                    <img class="l-arrow-review" src="./images/R.png"/>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container sitemap-page" style="padding: 0 20px;">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <p>
                    <h2>"CronixTour"-туристическое агентство в России</h2>

                    <br> Мы точно знаем, что отдых - это в первую очередь положительные эмоции и хорошее настроение. И
                    мы делаем все, чтобы вы получили незабываемое путешествие своей мечты.

                    <p>В CronixTour Вас ждут:
                    <ul class="list-unstyled">
                        <li>- лучшие цены на туры по России и загранице;</li>
                        <li>- горящие спецпредложения от ведущих туроператоров;</li>
                        <li>- индивидуальный подход к каждому клиенту;</li>
                        <li>- многообразие отелей;</li>
                        <li>- экскурсионные программы;</li>
                        <li> - лечение в России и зарубежом;</li>
                        <li>- круизы.</li>
                    </ul>
                    <p>Для особо искушенных путешественников мы сформируем индивидуальные туры и программы, которые
                        подразумевают тщательное планирование поездки с учетом всех пожеланий клиента.
                        Цены на все туры, указаны за двоих и актуальны на момент публикации! Все подробности уточняйте у
                        менеджеров!</p>
                    </p>
                </div>
                <div class="col-xl-10" style="margin-bottom: 40px">
                    <h2 style="padding-bottom: 20px">Как добраться:</h2>
                    <img src="{{asset('/images/reviews/24.png')}}" alt="" style="max-width: 100%">
                </div>
            </div>
        </div>
    </section>
@endsection

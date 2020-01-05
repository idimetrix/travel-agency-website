{{--{{ dd($tours, $countries, $destinations, $posts, $reviews) }}--}}
@extends('layouts.app')
@section('title')
    Наши Туристы- Cronix Tour
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
                        <h2>Наши туристы</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container insta-section tourist-section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="insta-photos-block-2">
                        <div class="inst-img-wrap one">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/1.jpeg')}}"/>
                            <div class="hover-inst-block">
                                <p>Всё было супер! Отдохнули отлично!
                                    <span class="hashtag" style="color: #0b43c6">
                                    <a target="_blank"
                                       href="https://www.instagram.com/cronixtour/">#cronixtour  #orel</a>
                                </span></p>
                            </div>
                        </div>

                        <div class="inst-img-wrap two">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/3.jpg')}}"/>
                            <div class="hover-inst-block">
                                <p> Сегодня утром вернулись из рая! Спасибо КрониксТуру!
                                    <span class="hashtag" style="color: #0b43c6">
                                   <a target="_blank"
                                      href="https://www.instagram.com/cronixtour/">#cronixtour  #orel</a>
                                </span>
                                </p>
                            </div>
                        </div>

                        <div class="inst-img-wrap three">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/2.jpg')}}"/>
                            <div class="hover-inst-block">
                                <p>Большое спасибо за прекрасный отдых!! Обожаю Египет!
                                    <span class="hashtag" style="color: #0b43c6">
                                   <a target="_blank"
                                      href="https://www.instagram.com/cronixtour/">#cronixtour  #orel</a>
                                </span>
                                </p>
                            </div>
                        </div>
                        <div class="inst-img-wrap four">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/4.jpg')}}"/>
                            <div class="hover-inst-block">
                                <p>Мы замечательно отдохнули!
                                    <span class="hashtag" style="color: #0b43c6">
                                 <a target="_blank" href="https://www.instagram.com/cronixtour/">#cronixtour  #orel</a>
                                </span>
                                </p>
                            </div>
                        </div>
                        <div class="inst-img-wrap five">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/6.jpg')}}"/>
                            <div class="hover-inst-block">
                                <p>Мы довольны！
                                    <span class="hashtag" style="color: #0b43c6">
                                   <a target="_blank"
                                      href="https://www.instagram.com/cronixtour/">#cronixtour  #orel</a>
                                </span>
                                </p>
                            </div>
                        </div>
                        <div class="inst-img-wrap six">
                            <img alt="image" class="lazy"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                 data-src="{{asset('/images/reviews/5.jpg')}}"/>
                            <div class="hover-inst-block">
                                <p>Настя, спасибо за прекрасный отдых!!! Вспоминаем теперь как сон))
                                    <span class="hashtag" style="color: #0b43c6">
                                        <a target="_blank" href="https://www.instagram.com/cronixtour/">#cronixtour #adventure  #orel</a>
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="pb-3">
            <ul class="pagination">
                <li class="page-item">
                    <a href="#" class="page-link disabled">‹</a>
                </li>
                <li class="page-item active">
                    <a href="" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="/tourists/2" class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a href="/tourists/3" class="page-link">3</a>
                </li>
                <li class="page-item">
                    <a href="/tourists/4" class="page-link">4</a>
                </li>
                <li class="page-item">
                    <a href="/tourists/5" class="page-link">5</a>
                </li>
                <li class="page-item">
                    <a href="/tourists/2" class="page-link">›</a>
                </li>
            </ul>
        </div>
    </section>

@endsection

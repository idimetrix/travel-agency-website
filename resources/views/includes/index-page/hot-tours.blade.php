{{--
Доступные переменные:
  $tours - коллекция туров
--}}
{{--{{dd($tours)}}--}}
@if(count($tours))
    <section class="hot-tours-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 hot-tours-title">
                    <h1 class="hide-on-mobile"><a href="/tours">Выгодные <br> предложения</a></h1>
                    <h1 class="show-on-mobile"><a href="/tours">Выгодные предложения</a></h1>
                    <h4>Успейте купить <br> по выгодной цене</h4>
                </div>
                <div class="col-xl-9 col-lg-8">

                    <div class="hot-tours owl-carousel">
                        @foreach($tours as $tour)

                            <a href="/tours/{{$tour->slug}}" class="hot-tour-item">
                                <div class="hot-tour-rating-wrap">
                                    <div class="hot-tour-rating-item"
                                         style="background: url('./images/rating-example.png')no-repeat"></div>
                                    <span class="count">{{$tour->duration}} дней</span>
                                    <span class="del-symb">|</span>
                                    <span class="count">{{$tour->tourists_number}} человек</span>
                                </div>

                                    <div  data-src="{{$tour->mainImage->url}}"
                                         class="hot-tour-info lazy position-relative">
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
                        @endforeach
                    </div>

                    <div class="hot-tours-nav-wrap" id="customNav-2">

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div>
                    <a href="/tours" class="btn-blue" style="margin-top: 30px">Смотреть все</a>
                </div>
            </div>
        </div>
    </section>
@endif


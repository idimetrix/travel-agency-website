<section class="tour-page-section" style="
    background: linear-gradient(to bottom,rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('{{$tour->mainImage->url}}') no-repeat;
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 59%, rgba(0, 0, 0, 0.65) 100%), url('{{$tour->mainImage->url}}') no-repeat;
    background-size: cover;">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>{{$tour->city}}, {{$tour->country}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
{{--{{dd($tour->departure_date)}}--}}
<div class="single-tour-wrap" data-tour-slug="{{$tour->slug}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="about-country-wrap">
                    @if(count($tour->images) > 1)
                    <div class="for-slider-wrap">
                        @foreach ($tour->images as $image)
                        <div class="slider-item">
                            <a href="{{$image->url}}">
                                <img class="loupe-icon" src="{{asset('/images/loupe.svg')}}">
                                <img class="slider-item-photo lazy" data-src="{{$image->url}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                            </a>
                        </div>
                            @endforeach
                    </div>

                    <div class="country-example-nav" id="country-example-nav">
                        @if(!(count($tour->images) <= 4))
                        <img class="r-arrow-review" style="margin-right: 20px" src="{{asset('/images/L.png')}}"/>
                        <img class="l-arrow-review" src=" {{asset('/images/R.png')}}"/>
                            @endif
                    </div>
                    @endif
                    <h4 class="country-name" @if(count($tour->images) <= 4) style="margin-top: 20px" @endif>О туре</h4>
                    <div class="about-tour-info">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="tour-info-key">Длительность</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="tour-info-value">{{$tour->duration}} дней</h4>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="tour-info-key">Кол-во туристов</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="tour-info-value">{{$tour->tourists_number}}</h4>
                                        <div class="vert-line"></div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="tour-info-key">Цена</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="tour-info-value">от {{round($tour->price)}} руб</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                {{--<div class="row">--}}
                                    {{--<div class="col-6">--}}
                                        {{--<p class="tour-info-key">Категории</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-6">--}}
                                        {{--<h4 class="tour-info-value">Activities</h4>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="tour-info-key">Вылет</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="tour-info-value">{{date('d-m-Y', strtotime($tour->departure_date)) }}</h4>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="tour-info-key">Питание</p>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="tour-info-value">{{$tour->food}}</h4>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <p class="notice-txt">Примечание</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="notice-txt blue-txt">{{$tour->note}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-5">--}}
                                {{----}}

                            {{--</div>--}}
                        {{--</div>--}}

                    </div>

                    <h4 class="tour-name">{{$tour->city}}</h4>
                    <div class="text-wrap">
                        <p>
                           {{$tour->description}}
                        </p>
                    </div>
                    {{--<div class="single-country-nav">--}}
                        {{--<div>--}}
                            {{--<p>Предыдущий</p>--}}
                            {{--<h3>Мексика</h3>--}}
                        {{--</div>--}}
                        {{--<div class='front-line'></div>--}}
                        {{--<div>--}}
                            {{--<p>Следующий</p>--}}
                            {{--<h3>Абхазия</h3>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                        <div class="col-lg-4 want-tour p-0">
                            <button data-toggle="modal" data-target="#tourModal" class="btn-blue tourModalbtn">Хочу этот тур!</button>
                        </div>
                </div>


                <div class="form-sub">
                    <form id="contact-form-2">
                        <h3 class="hide-on-mobile">
                            Оставьте заявку,  <br>и мы свяжемся с вами
                        </h3>
                        <h3 class="show-on-mobile">
                            Оставьте заявку , и мы свяжемся с вами
                        </h3>
                        <div class="line"></div>
                        <div class="fields">
                            <input class="name-input-field" name="name" type="text" placeholder="Имя">
                            <input class="number-input-field" type="text" name="phone" placeholder="Телефон">
                        </div>
                        <div>
                            <textarea placeholder="Вопрос" name="message"></textarea>
                        </div>
                        <div class="btns-wrap">
                            <button type="submit" class="btn-blue submit-button">
                                ОТПРАВИТЬ
                            </button>
                            <div class="check-box-wrap">
                                <input type="checkbox" checked="" id="access" class="custom-check">
                                <label class="check-label" for="access"> Я принимаю Правила передачи <br> и обработки
                                    персональных данных</label>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="for-search-module">
                    <script type="text/javascript" src="https://ui.sletat.ru/module-5.0/app.js" charset="utf-8"></script>
                    <script type="text/javascript">
                        sletat.createModule5('Search', {
                            files             : ["https://ui.sletat.ru/module-5.0/theme/sea_dec2015.min.css"],
                            agencyContact1    : {
                                logo            : "https://cronix-tour.ru/wp-content/uploads/2018/05/лого-кроникс-тур-1.png",
                                header          : "Туристическое агентство Cronix Tour",
                                phone           : "+7 (953) 622-22-57",
                                email           : "tour@cronix.ms",
                                content         : "Орел, ул.Ленина,17, ТЦ \"Малиновая вода\", 1 этаж"
                            },
                            enabledCurrencies : ["RUB", "EUR", "USD"],
                            useCard           : false,
                            formType          : "full"
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>

</div>

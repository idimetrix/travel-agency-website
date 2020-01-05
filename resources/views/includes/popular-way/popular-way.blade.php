<section class="country-example-section" style="
    background: linear-gradient(to bottom,rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)) ,url('{{$destination->mainImage->url}}') no-repeat;
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 59%, rgba(0, 0, 0, 0.65) 100%), url('{{$destination->mainImage->url}}') no-repeat; background-size: cover;">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>{{$destination->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="single-country-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="about-country-wrap">
                    @if(count($destination->images) > 1)
                    <div class="for-slider-wrap">
                        @foreach($destination->images as $image)
                        <div class="slider-item">
                            <a href="{{$image->url}}">
                                <img class="loupe-icon" src="{{asset('/images/loupe.svg')}}">
                                <img class="slider-item-photo lazy" data-src="{{$image->url}}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                            </a>
                        </div>
                            @endforeach

                    </div>

                    <div class="country-example-nav" id="country-example-nav">
                        @if(!(count($destination->images) <= 4))
                        <img class="r-arrow-review" style="margin-right: 20px" src="{{asset('/images/L.png')}}"/>
                        <img class="l-arrow-review" src=" {{asset('/images/R.png')}}"/>
                            @endif
                    </div>

                    @endif
                    <h4 class="country-name" @if(count($destination->images) <= 4) style="margin-top: 20px" @endif>{{$destination->title}}</h4>
                    <div class="text-wrap">
                        <p>
                            {!!$destination->description !!}
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


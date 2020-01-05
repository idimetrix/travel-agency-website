{{--
Доступные переменные:
  $destinations - коллекция популярных направлений для путешествия
--}}
<section class="popular-ways-section">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Популярные направления</h1>
                <h4 class="hide-on-mobile">Путешествие идеальное для вас</h4>
                <h4 class="show-on-mobile">Путешествие<br> идеальное для вас</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {{--{{dd($destinations)}}--}}
            <div class="popular-ways-wrap owl-carousel ">
                @foreach($destinations as $destination)
                <div class="popular-ways-item ">
                    <img alt="image" class="lazy"  src="https://placehold.it/5x5/000000/000000" data-src="{{$destination->mainImage->url}}">
                    <p class="item-title">
                        {{$destination->title}}
                    </p>
                    <div class="sub-title-block">
                        <p class="item-descr">
                            {{$destination->short_description}}
                        </p>
                        <a href="/destinations/{{$destination->slug}}" class="btn-blue">Узнать больше</a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pop-ways-nav">
                <div class="left-line"></div>
                <div id="customNav" class="owl-nav new-nav"></div>
                <div class="right-line"></div>
            </div>
        </div>
    </div>

</section>

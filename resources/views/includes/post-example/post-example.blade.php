<section class="example-post-section"
         style="
             background: linear-gradient(to bottom,rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('{{$post->mainImage->url}}')no-repeat;
             background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 59%, rgba(0, 0, 0, 0.65) 100%), url('{{$post->mainImage->url}}') no-repeat;
             background-size: cover;">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>{{$post->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
{{--{{dd($post)}}--}}
<div class="single-post-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="post-example-section">
                    <div class="post-top-nav">
                        <div>
                            <a href="/blog">
                                <img alt="image" src="{{asset('images/backbloglink.svg')}}"/>
                                Назад в блог
                            </a>
                        </div>
                        {{--<div class="likes-wrap">--}}
                            {{--<img alt="image" src="{{asset('images/Like.svg')}}"/>--}}
                            {{--<span class="like-count">{{$post->rating}}</span>--}}
                            {{--<img alt="image" src="{{asset('images/DLike.svg')}}"/>--}}
                        {{--</div>--}}
                    </div>
                    <div class="single-country-wrap">
                        @if(count($post->images) > 1)
                        <div class="about-country-wrap mt-0">
                                <div class="for-slider-wrap">
                                    @foreach($post->images as $image)
                                        <div class="slider-item">
                                            <a href="{{$image->url}}">
                                                <img alt="image" class="loupe-icon" src="/images/loupe.svg">
                                                <img alt="image" class="slider-item-photo lazy" data-src="{{$image->url}}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="country-example-nav" id="country-example-nav">
                                    @if(!(count($post->images) <= 4))
                                        <img class="r-arrow-review" style="margin-right: 20px" src="{{asset('/images/L.png')}}"/>
                                        <img class="l-arrow-review" src=" {{asset('/images/R.png')}}"/>
                                    @endif
                                </div>
                        </div>
                        @endif
                    </div>


                    <div class="post-text">
                        <h4>
                            {{$post->title}}
                        </h4>
                        <p class="post-descr">
                            {!! nl2br($post->description) !!}
                        </p>
                    </div>
                    <div class="post-top-nav bottom">
                        <div>
                            <a href="/blog">
                                <img alt="image" src="{{asset('images/backbloglink.svg')}}"/>
                                Назад в блог
                            </a>
                        </div>
                        {{--<div class="likes-wrap">--}}
                            {{--<img alt="image"  src="{{asset('images/Like.svg')}}"/>--}}
                            {{--<span class="like-count">{{$post->rating}}</span>--}}
                            {{--<img alt="image" src="{{asset('images/DLike.svg')}}"/>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            {{--<div class="col-12">--}}
                {{--<div class="read-also-block">--}}
                    {{--<div class="wrap-block">--}}
                        {{--<div class="line"></div>--}}
                        {{--<h3>Читайте также</h3>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-6 col-lg-4 blog-item-wrap">--}}
                            {{--<a href="/post" class="blog-item"--}}
                               {{--style="background: url('./images/blogitem1.jpg')no-repeat">--}}
                                {{--<div class="background-blog-full"--}}
                                     {{--style="background: url('{{asset("/images/backgroundblogfull.png")}}')no-repeat"></div>--}}
                                {{--<img alt="image" class="arrow-blog" src="{{asset('./images/arrowblog.png')}}"/>--}}
                                {{--<p class="blog-item-title">Зачем брать в самолет салфетки?</p>--}}
                                {{--<p class="blog-item-descr">Для того, чтобы войти в список лучших курортов, мало хорошей--}}
                                    {{--погоды – нужен еще и лучший сервис.--}}
                                    {{--Это и развитая инфраструктура, и пятизвездочные</p>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

</div>


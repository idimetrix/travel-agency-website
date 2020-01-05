{{--
Доступные переменные:
  $posts - коллекция постов из блога
--}}
@if(count($posts))
<section class="blog-section">

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="hide-on-mobile">Блог<br>Cronix Tour</h1>
                <h1 class="show-on-mobile">Блог Cronix Tour</h1>
            </div>
            <div class="col-lg-6">
                <div class="for-line"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>Полезные советы, интересные статьи<br>и многое другое</h4>
                <div class="blog-items-wrap">
                    {{--{{$posts->images}}--}}
                    @foreach($posts->take(3) as $post)

                        <div class="blog-item lazy" data-src="{{$post->mainImage->url}}">
                            <a href="/post/{{$post->slug}}">
                                <div class="background-blog-full"
                                     style="background: url('./images/backgroundblogfull.png')no-repeat"></div>
                                <img alt="image" class="arrow-blog lazy" data-src="./images/arrowblog.png" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/>
                                <p class="blog-item-title">{{$post->title}}</p>
                                <p class="blog-item-descr">{{$post->short_description}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="blog-nav-items" id="blogNav">
                    <img class="r-arrow-review" src="./images/L.png"/>
                    <img class="l-arrow-review" src="./images/R.png"/>
                </div>

                <div class="blog-link-wrap">
                    <a href="/blog" class="btn-blue">
                        перейти в блог
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>
    @endif




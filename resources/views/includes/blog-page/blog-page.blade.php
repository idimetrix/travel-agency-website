<section class="blog-page-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>Блог</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="blog-wrap">

    <div class="container">

        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4 blog-item-wrap">
                    <a href="/post/{{$post->slug}}" class="blog-item lazy"  data-src="{{$post->mainImage->url}}">
                        <div class="background-blog-full" style="background: url('./images/backgroundblogfull.png')no-repeat"></div>
                        <img alt="image" class="arrow-blog" src="./images/arrowblog.png"/>
                        <p class="blog-item-title">{{$post->title}}</p>
                        <p class="blog-item-descr">{{$post->short_description}}</p>
                    </a>
            </div>
           @endforeach
        </div>

        <div class="load-more-posts">
            {{ $posts->links() }}
            {{--<a class="btn-blue" href="#"></a>--}}
        </div>

    </div>

</div>




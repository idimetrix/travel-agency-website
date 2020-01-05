<section class="blog-page-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrap">
                    <div class="line-mob"></div>
                    <h2>Страны</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="blog-wrap countries-padding">

    <div class="container">

        <div class="row">
            @foreach($countries as $country)
                <div class="col-md-6 col-lg-4 blog-item-wrap">
                    <a href="/countries/{{$country->slug}}" class="blog-item" style="background: url('{{$country->mainImage->url}}')no-repeat">
                        <div class="background-blog-full"></div>
                        {{--<img alt="image" class="arrow-blog" src="./images/arrowblog.png"/>--}}
                        <p class="blog-item-title"> {{$country->title}}</p>
                        <p class="blog-item-descr">{{$country->short_description}}</p>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>


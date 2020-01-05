{{--
Доступные переменные:
  $reviews - коллекция отзывов
--}}

<section class="reviews-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Отзывы наших клиентов</h1>
                <h4>Мы делаем вас счастливее</h4>
                <div class="review-cards-wrap">

                    @foreach($reviews as $key => $review)
                        <div class="review-card">
                            <div class="top-review-block">
                                <img alt="image" data-src="{{$review->avatar->url}}"
                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                     class="review-img lazy"/>
                                <div class="author-wrap">
                                    <p class="review-author" title="{{$review->name}}">
                                        {{$review->name}}
                                    </p>
                                    {{--<img alt="image" src="./images/ratingimg.png"/>--}}
                                    <select class="review-rating" id="{{$key . 'rating'}}"
                                            data-rating="{{$review->rating}}">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="author-line"></div>
                            </div>
                            <div class="review-txt">
                                <p>
                                    {!! nl2br($review->body) !!}
                                </p>
                            </div>
                            <div class="review-date d-flex justify-content-between align-items-center"
                                 style="width: calc(100% - 45px)">
                                <div class="author-line"></div>
                                <p>
                                    {{date('d-m-Y', strtotime($review->date))}}
                                </p>
                                <span class="sourse-img">
                                        <a href="{{$review->link}}" target="_blank">
                                            @if(isset($review->icon))
                                                <img class="lazy" data-src="{{$review->icon->url}}" alt=""
                                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                                            @endif
                                        </a>
                                    </span>
                            </div>
                        </div>

                    @endforeach
                </div>

                <div class="all-reviews" id="allReviews">
                    <div class="left-line"></div>
                    <img class="r-arrow-review" src="./images/L.png"/>
                    <img class="l-arrow-review" src="./images/R.png"/>
                    <div class="right-line"></div>
                </div>

                <div class="all-reviews-link">
                    <a href="/reviews" class="btn-blue">
                      Читать все отзывы
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


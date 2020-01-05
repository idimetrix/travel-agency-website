<section class="top-title-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    <span class="line"></span>
                    Горящие туры <br>из России в любую страну</h2>
                <h3>от 14 000 руб</h3>
                <p class="hide-on-mobile">Ответьте на 5 вопросов и вы получите бесплатный расчет <br>
                    вашего тура и бронь на максимальную скидку</p>
                <p class="show-on-mobile">Ответьте на 5 вопросов <br> и вы получите бесплатный расчет<br>
                    вашего тура и бронь <br> на максимальную скидку</p>
                <button
                    onclick="Marquiz.init({ id: '5bf56311538bbc004439d766', autoOpen: false, openOnExit: false }); Marquiz.showModal('5bf56311538bbc004439d766');"
                    class="btn-blue marq-btn">
                    <?php
                    $buttons = array("Пройти тест", "Получить скидку", "Рассчитать тур", "Бесплатный расчет", "Оставить заявку");

                    echo $buttons[array_rand($buttons)]
                    ?>
                    <span class="sub-btn-txt">+ получить подарок  за прохождение теста</span>
                </button>

                <div class="right-side-txt-block">
                    <div class="left-line"></div>
                    <div class="right-line"></div>
                    <span>E</span><span>N</span><span>J</span><span>O</span><span>Y</span>
                    <span class="for-m-t">A</span><span>N</span><span
                        class="for-m-b">D</span><span>T</span><span>R</span>
                    <span>A</span><span>V</span><span>E</span><span>L</span>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="tour-test text-center">
                @unless (isset($_GET['SPEEDTEST']))
                    <h1>Кроникс Тур. Агентство экономных путешествий</h1>
                    {{--<h2 class="hide-on-mobile">Поиск туров по 120 тур операторам</h2>--}}
                    {{--<script defer type="text/javascript" src="https://ui.sletat.ru/module-5.0/app.js"--}}
                            {{--charset="utf-8"></script>--}}
                    {{--<script type="text/javascript">--}}
                        {{--window.addEventListener("load", function () {--}}
                            {{--setTimeout(function () {--}}
                                {{--sletat.createModule5('Search', {--}}
                                    {{--results: "full",--}}
                                    {{--resultFullCountRows: 15,--}}
                                    {{--resultGroupCountRows: 15,--}}
                                    {{--files: ["https://ui.sletat.ru/module-5.0/theme/sea_dec2015.min.css"],--}}
                                    {{--agencyContact1: {--}}
                                        {{--logo: "https://cronix-tour.ru/wp-content/uploads/2018/05/лого-кроникс-тур-1.png",--}}
                                        {{--header: "Туристическое агентство Cronix Tour",--}}
                                        {{--phone: "+7 (953) 622-22-57",--}}
                                        {{--email: "tour@cronix.ms",--}}
                                        {{--content: "Орел, ул.Ленина,17, ТЦ \"Малиновая вода\", 1 этаж"--}}
                                    {{--},--}}
                                    {{--enabledCurrencies: ["RUB", "EUR", "USD"],--}}
                                    {{--buyingType: "card",--}}
                                    {{--useCard: true,--}}
                                    {{--formType: "full"--}}
                                {{--});--}}
                            {{--}, 1000);--}}
                        {{--});--}}
                    {{--</script>--}}
                    <div class="pt-5">
                        <h1 class="mb-5">Горящие туры</h1>
                        {{--<script type="text/javascript" src="https://ui.sletat.ru/module-4.0/core.js"--}}
                                {{--charset="utf-8"></script>--}}
                        {{--<script type="text/javascript">sletat.FrameHot.$create({--}}
                                {{--toursCount: 8,--}}
                                {{--useCard: false,--}}
                                {{--enabledCurrencies: ["RUB"],--}}
                            {{--});</script>--}}

                        <script type="text/javascript" src="https://ui.sletat.ru/module-4.0/core.js" charset="utf-8"></script>
                        <script type="text/javascript">sletat.FrameSearch.$create({
                                radius                    : 2,
                                theme                     : "blue-light",
                                enabledCurrencies         : ["RUB", "EUR", "USD"],
                                useCard                   : false,
                                useAccountSettings        : false,
                                useTicketsIncludedControl : true
                            });</script>



                        <span class="sletat-copyright">Идет загрузка модуля <a href="https://sletat.ru/" title="поиск туров"
                                                                               target="_blank">поиска туров</a> &hellip;</span>
                    </div>


                @endunless
            </div>

        </div>
    </div>
</div>

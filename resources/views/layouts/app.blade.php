<!doctype html>
<html lang="ru">
@include('includes.main.head')
{{--<body style="opacity: 0;" onload="document.body.style.opacity='1';">--}}
<body>
@include('includes.main.preloader')
<div class="mobile-menu-white">
    <a style="text-decoration: underline;" onclick="Marquiz.init({ id: '5c766047cd1a99004492418a', autoOpen: false, openOnExit: false }); Marquiz.showModal('5c766047cd1a99004492418a');">Сколько
        стоит тур?</a>
    <a style="text-decoration: underline;" onclick="Marquiz.init({ id: '5c767d3fcd1a9900449243ae', autoOpen: false, openOnExit: false }); Marquiz.showModal('5c767d3fcd1a9900449243ae');">Куда
        полететь?</a>
    <div class="mob-hamburger-wrap">
        <span class="hamburger-line"></span>
    </div>
</div>
<div class="main-content">
    @include('includes.main.header')
    @yield('content')
    @include('includes.main.footer')
</div>
@include('includes.menu-modal')
{{--@include('includes.fortune-modal')--}}
{{--@include('includes.tour-form-modal')--}}

<div class="slide-menu">
    <ul>
        <li class="nav-left-side-item"><a href="/about">Мы</a></li>
        <li class="nav-left-side-item"><a href="/tours">Туры</a></li>
        <li class="nav-left-side-item"><a href="/countries">Страны</a></li>
        <li class="nav-left-side-item"><a href="/reviews">Отзывы</a></li>
        <li class="nav-left-side-item"><a href="/blog">Блог</a></li>
        <li class="nav-left-side-item"><a href="/sitemap">Карта сайта</a></li>
        <li class="nav-left-side-item"><a href="/contacts">Контакты</a></li>
    </ul>
</div>
@include('includes.proof-toast')
@include('offer-modals.offer-modals')
<script defer src="{{ mix('/js/app.js') }}"></script>

@unless (isset($_GET['SPEEDTEST']))
<script defer src="//script.marquiz.ru/v1.js"></script>
{{--<script defer src="https://mssg.me/widget/cronixtour"></script>--}}
@endunless

<script type="application/ld+json">
    @yield('schema')
</script>
</body>
</html>

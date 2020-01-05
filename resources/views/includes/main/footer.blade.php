<footer
    @if((request()->path()=='sitemap') || (request()->path()=='about') || (request()->path()=='tourists') ||
    request()->is('post/*') || request()->is('tourists/*')) style="margin-top: 0" @endif
    class="{{!(request()->is('post/*')) && !(request()->path()=='blog') && !(request()->path()=='sitemap') && !(request()->path()=='about') && !(request()->path()=='tourists') && !(request()->is('tourists/*')) ? 'footer-transparent' : ''}}">

    <div class="container">
        <div class="row footer-wrap">
            <div class="col-xl-6 col-lg-7 col-md-12 col-12">
                <div class="footer-logo-wrap">
                    <a class="footer-link" href="/">
                        <img src="{{asset('/images/logonew.png')}}" alt="logo" class="">
                    </a>
                    <div class="social-icons-block">
                        <a href="https://vk.com/cronixtour" target="_blank">
                            <img  src="{{asset('/images/vk.png')}}" alt="logo"/>
                        </a>
                        <a href="https://www.instagram.com/cronixtour/" target="_blank">
                            <img src="{{asset('/images/inst.png')}}" alt="logo"/>
                        </a>
                        <a href="https://ok.ru/group/54388175405243" target="_blank">
                            <img class="ok-soc-img" src="{{asset('/images/ok.png')}}" alt="logo" style="height: 30px">
                        </a>
                        <a href="https://2gis.ru/orel/firm/70000001032256194" target="_blank">
                            <img src="{{asset('/images/togis.png')}}" alt="logo"/>
                        </a>
                        <a href="https://www.yell.ru/orel/com/cronix-tour_11944627/" target="_blank">
                            <img src="{{asset('/images/yell.png')}}" alt="logo"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-1 hide-on-mobile sitemap-link">
                <a href="/sitemap">
                    Карта сайта
                </a>
            </div>
            <div class="col-4 hide-on-mobile">
                <div class="footer-info-block">
                    <div class="phone-icon-wrap">
                        <img alt="image" src="{{asset('/images/phone-icon.png')}}">
                    </div>
                    <a href="tel:+79536222257">+7 (953) 622 22 57</a>
                </div>
            </div>
        </div>
    </div>
</footer>

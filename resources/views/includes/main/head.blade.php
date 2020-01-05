<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="canonical" href="{{request()->getHost()}}">
    {{--<meta name="yandex-verification" content="c287a2c75b4f7ab9" />--}}
    <meta name="keywords" content="@yield('keywords')" />
    {{--FavIcons--}}
    {{--General--}}
    <link rel='shortcut icon' href='{{asset('images/cronixtour-icon.png')}}' type="image/png"/>
    <link rel='shortcut icon' href='{{asset('images/cronixtour-icon.ico')}}' type="image/x-icon"/>
    {{--Iphone and IPad--}}
    <link rel="apple-touch-icon" href="{{asset('images/safari_60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/safari_76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/safari_120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/safari_152.png')}}">

    <meta name="msapplication-TileColor" content="#2196f3">
    <meta name="application-name" content="CronixTour">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta-description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('open-graph')

    <style>
        <?php
        include(public_path() . '/css/critical.css');
        ?>
    </style>

    {{--<link rel="preload" as="style" href="{{mix('/css/critical.css')}}" onload="this.rel = 'stylesheet'">--}}
    <link rel="stylesheet" as="style" href="{{mix('/css/app.css')}}" onload="this.onload = null;this.rel = 'stylesheet'">


    {{--<link rel="stylesheet" href="{{ mix('/css/app.css') }}" as="style">--}}
    {{--<link rel="preload" href="/fonts/Montserrat-Medium.woff" as="font" type="font/woff" crossorigin="anonymous">--}}
    {{--<link rel="preload" href="/fonts/Montserrat-ExtraBold.woff" as="font" type="font/woff" crossorigin="anonymous">--}}
    {{--<link rel="preload" href="/fonts/Montserrat-Bold.woff" as="font" type="font/woff" crossorigin="anonymous">--}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134848918-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-134848918-1');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
      (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
      (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
      ym(49191817, "init", {
        id:49191817,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
      });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/49191817" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</head>

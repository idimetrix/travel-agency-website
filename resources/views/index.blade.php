@extends('layouts.app')
@section('title')
    Туры из России 2019: автобусные туры, туры к морю, отдых на море, горящие туры / Кроникс тур
@endsection
@section('meta-description')
    Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.
@endsection
@section('keywords')
    автобусные туры, туры к морю, отдых на море
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="Туры из России 2018: автобусные туры, туры к морю, отдых на море, горящие туры / Кроникс тур">
    <meta property="og:description"
          content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta property="og:url" content="{{request()->getHost()}}">
    <meta property="og:site_name" content="Cronix Tour">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description"
          content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta name="twitter:title"
          content="Туры из России 2018: автобусные туры, туры к морю, отдых на море, горящие туры / Кроникс тур">
@endsection
@section('content')
    @include('includes.index-page.top-title')
    @include('includes.index-page.hot-tours')
    @include('includes.index-page.popular-ways')
    @include('includes.index-page.reviews')
    @include('includes.index-page.insta')
    @include('includes.index-page.blog')
    @include('includes.index-page.free-consult')
@endsection


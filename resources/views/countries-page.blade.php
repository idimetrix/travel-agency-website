
@extends('layouts.app')
@section('title')
    Страны - Cronix Tour
@endsection
@section('meta-description')
    Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.
@endsection
@section('keywords')
    автобусные туры, туры к морю, отдых на море
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="article">
    <meta property="og:title"
          content="Страны - Cronix Tour">
    <meta property="og:description"
          content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta property="og:url" content="{{request()->getHost()}}/countries">
    <meta property="og:site_name" content="Cronix Tour">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="Турагентство в России CronixTour. У нас вы можете подобрать туры из России на море, автобусные туры по Европе, горящие туры, экскурсии по России, экскурсионные туры из России и туры на море заграницей.">
    <meta name="twitter:title" content="Туры из России 2018: автобусные туры, туры к морю, отдых на море, горящие туры / Кроникс тур">
@endsection
@section('content')
    @include('includes.countries-page.countries-page')
    @include('includes.index-page.free-consult')

@endsection


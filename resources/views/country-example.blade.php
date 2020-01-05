@extends('layouts.app')
@section('title')
    {{$country->title}}- Кроникс Тур
@endsection
@section('meta-description')
    {{$country->meta_description}}
@endsection
@section('keywords')
    {{$country->meta_keywords}}
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="{{$country->title}} - Cronix Tour">
    <meta property="og:description"
          content="{{$country->meta_description}}">
    <meta property="og:url" content="{{request()->getHost()}}/countries/{{$country->slug}}">
    <meta property="og:site_name" content="Cronix Tour">
    <meta property="og:image" content="{{$country->mainImage->url}}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="{{$country->meta_description}}">
    <meta name="twitter:title" content="{{$country->meta_title}}">
@endsection
@section('content')
    @include('includes.country-example.country-example')
    @include('includes.index-page.free-consult')
@endsection




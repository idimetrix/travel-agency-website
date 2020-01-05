@extends('layouts.app')
@section('title')
    {{$tour->meta_title}} - Кроникс Тур
@endsection
@section('meta-description')
    {{$tour->meta_description}}
@endsection
@section('keywords')
    {{$tour->meta_keywords}}
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="{{$tour->meta_title}}-Кроникс Тур">
    <meta property="og:description"
          content="{{$tour->meta_description}}">
    <meta property="og:url" content="{{request()->getHost()}}/tours/{{$tour->slug}}">
    <meta property="og:site_name" content="Cronix Tour">
    <meta property="og:image" content="{{$tour->mainImage->url}}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="{{$tour->meta_description}}">
    <meta name="twitter:title" content="{{$tour->meta_title}}">
@endsection
@section('content')
    @include('includes.tour-page.tour-page')
    @include('includes.index-page.free-consult')
@endsection




@extends('layouts.app')
@section('title')
    {{$destination->meta_title}} - Кроникс Тур
@endsection
@section('meta-description')
    {{$destination->meta_description}}
@endsection
@section('keywords')
    {{$destination->meta_keywords}}
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="{{$destination->meta_title}}-Кроникс Тур">
    <meta property="og:description"
          content="{{$destination->meta_description}}">
    <meta property="og:url" content="{{request()->getHost()}}/destinations/{{$destination->slug}}">
    <meta property="og:site_name" content="Cronix Tour">
    <meta property="og:image" content="{{$destination->mainImage->url}}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="{{$destination->meta_description}}">
    <meta name="twitter:title" content="{{$destination->meta_title}}">
@endsection
@section('content')
    @include('includes.popular-way.popular-way')
    @include('includes.index-page.free-consult')
@endsection




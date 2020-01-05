@extends('layouts.app')
@section('title')
    {{$post->meta_title}}- Cronix Tour
@endsection
@section('meta-description')
    {{$post->meta_description}}
@endsection
@section('keywords')
    {{$post->meta_keywords}}
@endsection
@section('open-graph')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="{{$post->meta_title}}-Кроникс Тур">
    <meta property="og:description"
          content="{{$post->meta_description}}">
    <meta property="og:url" content="{{request()->getHost()}}/post/{{$post->slug}}">
    <meta property="og:site_name" content="Cronix Tour">
    <meta property="og:image" content="{{$post->mainImage->url}}" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="{{$post->meta_description}}">
    <meta name="twitter:title" content="{{$post->meta_title}}">
@endsection
@section('content')
    @include('includes.post-example.post-example')
@endsection




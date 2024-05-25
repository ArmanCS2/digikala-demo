@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta property="og:title" content="{{$setting->title}}"/>
    <meta property="og:description" content="{{$setting->description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{asset(str_replace('\\','/',$setting->logo))}}">
    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$page->tags}}">
    <title>{{$page->title}}</title>
@endsection


@section('content')
    <section class="bg-white p-5 m-4">
        {!! $page->body !!}
    </section>

@endsection

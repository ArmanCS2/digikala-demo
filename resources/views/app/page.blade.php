@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta name="description" content="بوتیکالا صفحات">
    <meta name="keywords" content="{{$page->tags}}">
    <title>{{$page->title}}</title>
@endsection


@section('content')
    <section class="bg-white p-5 m-4">
        {!! $page->body !!}
    </section>

@endsection

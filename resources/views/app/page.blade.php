@extends('app.layouts.master-one-col')

@section('head-tag')
    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $page->title ?? $setting->title }}">
    <meta property="og:description" content="{{ $page->seo_description ?? $setting->description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset(str_replace('\\','/', $setting->logo)) }}">
    <meta property="og:type" content="article">

    {{-- SEO Meta --}}
    <meta name="description" content="{{ $page->seo_description ?? $setting->description }}">
    <meta name="keywords" content="{{ $page->tags }}">
    <title>{{ $page->title }}</title>
@endsection


@section('content')

    <section class="bg-white p-5 m-4 rounded-2 shadow-sm">
        {!! $page->body !!}
    </section>

@endsection

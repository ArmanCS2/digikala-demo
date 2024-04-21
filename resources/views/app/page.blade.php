@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>{{$page->title}}</title>
@endsection


@section('content')
    <section class="bg-white p-5">
        {!! $page->body !!}
    </section>

@endsection

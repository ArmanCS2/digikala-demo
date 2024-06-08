@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta property="og:title" content="ویدیو محصولات بوتیکالا"/>
    <meta property="og:description" content="{{$setting->description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{asset(str_replace('\\','/',$setting->logo))}}">
    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$setting->keywords}}">
    <title>ویدیو محصولات</title>
@endsection


@section('content')
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item font-size-12"><a class="text-decoration-none text-dark"
                                                            href="{{route('home')}}">صفحه اصلی</a></li>
                <li class="breadcrumb-item font-size-12 active" aria-current="page"><a
                        class="text-decoration-none text-dark"
                        href="{{url()->current()}}">ویدیو محصولات</a>
                </li>
            </ol>
        </nav>

        <section class="row my-4 d-flex justify-content-center">

            <section class="row d-flex justify-content-center">
                @forelse($videos as $video)
                    <section class="col-md-2 m-1">
                        <section>
                            {!! $video->link !!}
                            <section class="video-name">
                                <h3><a class="text-dark" href="{{url($video->url)}}">{{$video->title}}</a></h3>
                            </section>
                        </section>
                    </section>
                @empty
                    <p>ویدیویی یافت نشد</p>
                @endforelse
            </section>


            <section class="my-4 d-flex justify-content-center border-0">
                {{$videos->links('pagination::custom')}}
            </section>


        </section>


    </section>
@endsection




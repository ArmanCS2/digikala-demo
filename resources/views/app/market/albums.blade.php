@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta property="og:title" content="آلبوم بوتیکالا"/>
    <meta property="og:description" content="{{$setting->description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{asset(str_replace('\\','/',$setting->logo))}}">
    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$setting->keywords}}">
    <title>آلبوم</title>
@endsection


@section('content')
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item font-size-12"><a class="text-decoration-none text-dark"
                                                            href="{{route('home')}}">صفحه اصلی</a></li>
                <li class="breadcrumb-item font-size-12 active" aria-current="page"><a
                        class="text-decoration-none text-dark"
                        href="{{url()->current()}}">آلبوم</a>
                </li>
            </ol>
        </nav>

        <section class="row my-4 d-flex justify-content-center">

            <section class="row d-flex justify-content-center">
                @foreach($albums as $album)

                    <section class="col-md-2 m-1">
                        <section class="product">
                            <a class="product-link" href="{{url($album->link)}}">
                                <section class="album-image">
                                    @if($album->type==0)
                                        <img
                                            src="{{asset($album->image)}}"
                                            alt="{{$album->name}}">
                                    @else
                                        <video
                                            class="d-flex align-items-center justify-content-center"
                                            src="{{asset($album->video)}}" controls></video>
                                    @endif
                                </section>
                            </a>
                        </section>
                    </section>

                @endforeach
            </section>


            <section class="my-4 d-flex justify-content-center border-0">
                {{$albums->links('pagination::custom')}}
            </section>


        </section>


    </section>
@endsection




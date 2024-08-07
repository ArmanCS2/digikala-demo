@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta property="og:title" content="وبلاگ بوتیکالا"/>
    <meta property="og:description" content="{{$setting->description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{asset(str_replace('\\','/',$setting->logo))}}">
    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$setting->keywords}}">
    <title>وبلاگ</title>
@endsection


@section('content')
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item font-size-12"><a class="text-decoration-none text-dark"
                                                            href="{{route('home')}}">صفحه اصلی</a></li>
                <li class="breadcrumb-item font-size-12 active" aria-current="page"><a
                        class="text-decoration-none text-dark"
                        href="{{url()->current()}}">وبلاگ</a>
                </li>
            </ol>
        </nav>

        <section class="row my-4 d-flex justify-content-center">

            <section class="row d-flex justify-content-center">
                @forelse($posts as $post)
                    <section class="col-md-2 m-1">
                        <section class="product">
                            <a class="product-link d-flex flex-column justify-content-center"
                               href="{{route('content.post',$post)}}">
                                <section class="product-image">
                                    <img class=""
                                         src="{{asset($post->image['indexArray'][$post->image['currentImage']])}}"
                                         alt="{{$post->name}}">
                                </section>
                                <section class="product-name">
                                    <h2 class="d-flex justify-content-center">{{$post->title}}</h2>
                                </section>
                            </a>
                        </section>
                    </section>
                @empty
                    <p>پستی یافت نشد</p>
                @endforelse
            </section>


            <section class="my-4 d-flex justify-content-center border-0">
                {{$posts->links('pagination::custom')}}
            </section>


        </section>


    </section>
@endsection




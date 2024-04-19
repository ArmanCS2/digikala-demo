@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>وبلاگ</title>
@endsection


@section('content')
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

        <section class="row my-4 d-flex justify-content-start">

            <section class="row d-flex justify-content-center">
                @forelse($posts as $post)
                    <section class="col-md-2 m-1">
                        <section class="product">
                            <a class="product-link" href="{{route('content.post',$post)}}">
                                <section class="product-image">
                                    <img class=""
                                         src="{{asset($post->image['indexArray'][$post->image['currentImage']])}}"
                                         alt="{{$post->name}}">
                                </section>
                                <section class="product-name">
                                    <h3>{{$post->title}}</h3>
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




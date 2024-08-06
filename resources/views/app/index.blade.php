@extends('app.layouts.master-one-col')

@section('head-tag')
    <meta property="og:title" content="{{$setting->title}}"/>
    <meta property="og:description" content="{{$setting->description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{asset(str_replace('\\','/',$setting->logo))}}">
    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$setting->keywords}}">
    <title>بوتیکالا</title>
@endsection

@section('content')
    <h1 class="d-none">بوتیکالا | بوتی کالا | بوتیک کالا | فروشگاه آنلاین تی شرت تیشرت مردانه آستین بلند آستین کوتاه لش ساده یقه دار
        پیراهن
        مردانه رسمی انواع پوشاک و انواع اکسسوری</h1>
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">
            <section class="col-md-8 pe-md-1 ">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($slideShows as $slideShow)
                        <section class="item"><span class="w-100 d-block h-auto text-decoration-none"><img
                                    class="w-100 rounded-2 d-block h-auto" src="{{asset($slideShow->image)}}"
                                    alt="{{$slideShow->title}}"></span></section>
                    @endforeach
                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $topBanner)
                    <section class="mb-2"><span class="d-block"><img class="w-100 rounded-2 ratio ratio-16x9"
                                                                     src="{{asset($topBanner->image)}}"
                                                                     alt="{{$topBanner->title}}"></span>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->
    <!-- start product lazy load -->
    @if($albums->count()>0)
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>آلبوم تصاویر</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{route('market.albums')}}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach($albums as $album)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
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
                                        </section>
                                    @endforeach
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    @endif
    <!-- end product lazy load -->

    <!-- start videos -->
    @if($videos->count() > 0)
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>ویدیو محصولات</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{route('content.videos')}}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach($videos as $video)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section>
                                                    {!! $video->link !!}
                                                    <section class="video-name">
                                                        <h3><a class="text-dark"
                                                               href="{{url($video->url)}}">{{$video->title}}</a></h3>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                    @endforeach
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    @endif
    <!-- end videos -->

    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a class="product-link" href="{{route('market.products',['sort'=>5])}}">مشاهده
                                        همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($mostViewedProducts as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a
                                                        href="{{route('market.cart.add-product',[$product])}}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></a></section>
                                                @auth
                                                    @if($product->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i
                                                                    class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm"
                                                                data-url="{{route('market.product.is-favorite',$product)}}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="افزودن به علاقه مندی"><i
                                                                class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{route('market.product',$product)}}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                                             alt="{{$product->name}}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{$product->name}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($product->activeAmazingSale() ?? []))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($product->activeAmazingSale()->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $product->activeAmazingSale()->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @elseif(!empty($commonDiscount))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $commonDiscount->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{priceFormat($product->price)}}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($product->colors ?? [] as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$color->color}};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->


    <!-- start ads section -->
    @if($topAds->count() >0)
        <section class="mb-3 bg-gray">
            <section class="container-xxl">
                <!-- one column -->
                <section class="row py-4 d-flex justify-content-center">
                    @foreach($topAds as $ad)
                        <section class="col-2"><a href="{{url($ad->url)}}">
                                <img
                                    class="d-block rounded-2 w-100" src="{{$ad->image}}" alt="{{$ad->title}}">
                            </a>
                        </section>
                    @endforeach
                </section>
            </section>
        </section>
    @endif
    <!-- end ads section -->



    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پر فروش ترین کالا ها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{route('market.products',['sort'=>6])}}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($bestSalesProducts as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a
                                                        href="{{route('market.cart.add-product',[$product])}}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></a></section>
                                                <section class="product-add-to-favorite"><a href="#"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="left"
                                                                                            title="افزودن به علاقه مندی"><i
                                                            class="fa fa-heart"></i></a></section>
                                                @auth
                                                    @if($product->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i
                                                                    class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm"
                                                                data-url="{{route('market.product.is-favorite',$product)}}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="افزودن به علاقه مندی"><i
                                                                class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{route('market.product',$product)}}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                                             alt="{{$product->name}}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{$product->name}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($product->activeAmazingSale() ?? []))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($product->activeAmazingSale()->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $product->activeAmazingSale()->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @elseif(!empty($commonDiscount))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $commonDiscount->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{priceFormat($product->price)}}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($product->colors ?? [] as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$color->color}};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->


    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col"><span class="w-100 d-block h-auto text-decoration-none"><img
                            class="d-block rounded-2 w-100" src="{{$bottomBanner->image}}"
                            alt="{{$bottomBanner->title}}"></span>
                </section>
            </section>
        </section>
    </section>
    <!-- end ads section -->

    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد بوتیکالا به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{route('market.products')}}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($offerProducts as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a
                                                        href="{{route('market.cart.add-product',[$product])}}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></a></section>
                                                @auth
                                                    @if($product->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i
                                                                    class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm"
                                                                data-url="{{route('market.product.is-favorite',$product)}}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="افزودن به علاقه مندی"><i
                                                                class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{route('market.product',$product)}}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                                             alt="{{$product->name}}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{$product->name}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($product->activeAmazingSale() ?? []))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($product->activeAmazingSale()->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $product->activeAmazingSale()->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @elseif(!empty($commonDiscount))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $commonDiscount->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{priceFormat($product->price)}}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($product->colors ?? [] as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$color->color}};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start ads section -->
    <section class="mb-3 bg-gray">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4 d-flex justify-content-center">
                @foreach($ads as $ad)
                    <section class="col-2"><a href="{{url($ad->url)}}">
                            <img
                                class="d-block rounded-2 w-100" src="{{$ad->image}}" alt="{{$ad->title}}">
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>جدیدترین کالا ها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{route('market.products',['sort'=>1])}}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($newProducts as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a
                                                        href="{{route('market.cart.add-product',[$product])}}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></a></section>
                                                <section class="product-add-to-favorite"><a href="#"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="left"
                                                                                            title="افزودن به علاقه مندی"><i
                                                            class="fa fa-heart"></i></a></section>
                                                @auth
                                                    @if($product->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm"
                                                                    data-url="{{route('market.product.is-favorite',$product)}}"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="left"
                                                                    title="افزودن به علاقه مندی"><i
                                                                    class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm"
                                                                data-url="{{route('market.product.is-favorite',$product)}}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="افزودن به علاقه مندی"><i
                                                                class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{route('market.product',$product)}}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                                             alt="{{$product->name}}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{$product->name}}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @if(!empty($product->activeAmazingSale() ?? []))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($product->activeAmazingSale()->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $product->activeAmazingSale()->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @elseif(!empty($commonDiscount))
                                                            <section class="product-discount">
                                                                <span
                                                                    class="product-old-price">{{priceFormat($product->price)}}</span>
                                                                <span
                                                                    class="product-discount-amount"> % {{convertEnglishToPersian($commonDiscount->percentage)}}</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{priceFormat($product->price - ($product->price * $commonDiscount->percentage / 100))}}
                                                                تومان
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{priceFormat($product->price)}}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($product->colors ?? [] as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$color->color}};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach($middleBanners as $middleBanner)
                    <section class="col-12 col-md-6 mt-2 mt-md-0"><a href="{{$middleBanner->url}}"><img
                                class="d-block rounded-2 w-100"
                                src="{{asset($middleBanner->image)}}" alt="{{$middleBanner->title}}"></a>
                    </section>
                @endforeach
            </section>

        </section>
    </section>
    <!-- end ads section -->

    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>آخرین مقالات</span>
                            </h2>
                            <section class="content-header-link">
                                <a href="{{route('content.posts')}}">مشاهده همه</a>
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($posts as $post)
                                <section class="item border">
                                    <section class="brand-item mt-3">
                                        <a href="{{route('content.post',$post)}}"><img class="rounded-2"
                                                                                       src="{{asset($post->image['indexArray'][$post->image['currentImage']])}}"
                                                                                       alt="{{$post->title}}"></a>
                                    </section>
                                    <section class="brand-item my-3">
                                        <a class="text-dark" href="{{route('content.post',$post)}}">{{$post->title}}</a>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->

    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        {{--                                        <a href="{{route('market.products',['brands'=>[$brand->id]])}}"><img--}}
                                        {{--                                                class="rounded-2"--}}
                                        {{--                                                src="{{asset($brand->logo['indexArray'][$brand->logo['currentImage']])}}"--}}
                                        {{--                                                alt="{{$brand->persian_name}}"></a>--}}
                                        <img class="rounded-2"
                                             src="{{asset($brand->logo['indexArray'][$brand->logo['currentImage']])}}"
                                             alt="{{$brand->persian_name}}">
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->
@endsection

@section('scripts')

    <script>
        $('.product-add-to-favorite button').click(function () {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    console.log(result)
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                        successToast('محصول به علاقه مندی ها اضافه شد');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن به علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                        successToast('محصول از علاقه مندی ها حذف شد');
                    } else if (result.status == 3) {
                        infoToast('برای افزودن به علاقه مندی وارد حساب کاربری خود شوید');
                    }
                }
            })


            function successToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function infoToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-info text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<a class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '</a>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }
        })
    </script>

@endsection

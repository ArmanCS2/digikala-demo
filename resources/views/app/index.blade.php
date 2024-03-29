@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>دیجی کالا</title>
@endsection

@section('content')
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">
            <section class="col-md-8 pe-md-1 ">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($slideShows as $slideShow)
                        <section class="item"><a class="w-100 d-block h-auto text-decoration-none"
                                                 href="{{$slideShow->url}}"><img
                                    class="w-100 rounded-2 d-block h-auto" src="{{asset($slideShow->image)}}"
                                    alt="{{$slideShow->title}}"></a></section>
                    @endforeach
                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $topBanner)
                    <section class="mb-2"><a href="{{$topBanner->url}}" class="d-block"><img class="w-100 rounded-2"
                                                                                             src="{{asset($topBanner->image)}}"
                                                                                             alt="{{$topBanner->title}}"></a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->


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
                                    <a href="{{route('market.products',['sort'=>5])}}">مشاهده همه</a>
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
                                                        <h3>{{\Illuminate\Support\Str::limit($product->name,30)}}</h3>
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
                    <section class="col-12 col-md-6 mt-2 mt-md-0"><a
                            class="w-100 d-block h-auto text-decoration-none"
                            href="{{$middleBanner->url}}"><img
                                class="d-block rounded-2 w-100"
                                src="{{asset($middleBanner->image)}}" alt="{{$middleBanner->title}}"></a>
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
                                    <span>پیشنهاد آمازون به شما</span>
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
                                                        <h3>{{\Illuminate\Support\Str::limit($product->name,30)}}</h3>
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
                <section class="col"><a class="w-100 d-block h-auto text-decoration-none"
                                        href="{{$bottomBanner->url}}"><img
                            class="d-block rounded-2 w-100" src="{{$bottomBanner->image}}"
                            alt="{{$bottomBanner->title}}"></a>
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
                                                        <h3>{{\Illuminate\Support\Str::limit($product->name,30)}}</h3>
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


    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>آخرین مقالات</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($posts as $post)
                                <section class="item">
                                    <section class="brand-item">
                                        <a href="https://armanafzali.ir"><img class="rounded-2"
                                                                              src="{{asset($post->image['indexArray'][$post->image['currentImage']])}}"
                                                                              alt=""></a>
                                    </section>
                                    <section class="brand-item mt-2">
                                        در باره {{$post->title}} بیشتر بخوانید ...
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

    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                @foreach($ads as $ad)
                    <section class="col"><a class="w-100 d-block h-auto text-decoration-none"
                                            href="https://armanafzali.ir"><img
                                class="d-block rounded-2 w-100" src="{{$ad->image}}" alt="{{$ad->title}}"></a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end ads section -->


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
                                        <a href="{{route('market.products',['brands'=>[$brand->id]])}}"><img
                                                class="rounded-2"
                                                src="{{asset($brand->logo['indexArray'][$brand->logo['currentImage']])}}"
                                                alt="{{$brand->persian_name}}"></a>
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
                    '<a href="{{route('auth.customer.login-register-form')}}" class="text-white">ورود</a>\n' +
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

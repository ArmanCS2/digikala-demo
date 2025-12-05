@extends('app.layouts.master-one-col')

@section('head-tag')

    @php
        $title = $setting->title ?: "بوتیکالا | فروشگاه آنلاین پوشاک و اکسسوری";
        $description = $setting->description ?: "خرید بهترین پوشاک، اکسسوری، تیشرت، پیراهن، لباس مردانه و زنانه با قیمت مناسب در بوتیکالا.";
        $keywords = $setting->keywords ?: "بوتیکالا, خرید پوشاک, خرید تیشرت, لباس مردانه, لباس زنانه, اکسسوری";
        $logo = asset(str_replace('\\','/',$setting->logo));
        $canonical = url('/');
    @endphp

    <title>{{ $title }}</title>

    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ $canonical }}">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:description" content="{{ $description }}"/>
    <meta property="og:url" content="{{ $canonical }}"/>
    <meta property="og:image" content="{{ $logo }}">
    <meta property="og:site_name" content="بوتیکالا">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $logo }}">

    <!-- Schema: WebSite + Search Box -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "بوتیکالا",
      "url": "{{ $canonical }}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/search') }}?search={query}",
        "query-input": "required name=query"
      }
    }
    </script>

    <!-- Schema: Organization -->
    <script type="application/ld+json">
    {
     "@context": "https://schema.org",
     "@type": "Organization",
     "name": "{{ $setting->title }}",
     "url": "{{ $canonical }}",
     "logo": "{{ $logo }}",
     "sameAs": [
       "{{ $setting->instagram ?? '' }}",
       "{{ $setting->telegram ?? '' }}",
       "{{ $setting->twitter ?? '' }}"
     ]
    }
    </script>

    <!-- Schema: WebPage (Homepage) -->
    <script type="application/ld+json">
    {
     "@context": "https://schema.org",
     "@type": "WebPage",
     "name": "{{ $title }}",
     "description": "{{ $description }}",
     "url": "{{ $canonical }}",
     "image": "{{ $logo }}"
    }
    </script>

@endsection

@section('content')
    {{-- H1 اصلی صفحه (برای سئو، بدون تغییر ظاهری) --}}
    <h1 class="d-none">
        بوتیکالا | فروشگاه اینترنتی پوشاک، تیشرت، پیراهن، لباس مردانه، لباس زنانه و انواع اکسسوری
    </h1>

    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">
            <section class="col-md-8 pe-md-1">
                <section id="slideshow" class="owl-carousel owl-theme" aria-label="اسلایدشو بوتیکالا">
                    @foreach($slideShows as $slideShow)
                        <section class="item">
                            <span class="w-100 d-block h-auto text-decoration-none">
                                <img
                                    class="w-100 rounded-2 d-block h-auto"
                                    src="{{ asset($slideShow->image) }}"
                                    alt="اسلاید {{ $loop->iteration }} - {{ $slideShow->title }}"
                                >
                            </span>
                        </section>
                    @endforeach
                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $topBanner)
                    <section class="mb-2">
                        <span class="d-block">
                            <img
                                class="w-100 rounded-2 ratio ratio-16x9"
                                src="{{ asset($topBanner->image) }}"
                                alt="بنر بالای صفحه - {{ $topBanner->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </span>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->

    <!-- start product lazy load (albums) -->
    @if($albums->count() > 0)
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start content header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>آلبوم تصاویر</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{ route('market.albums') }}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- end content header -->

                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme" aria-label="آلبوم تصاویر محصولات">
                                    @foreach($albums as $album)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <a class="product-link" href="{{ url($album->link) }}">
                                                        <section class="album-image">
                                                            @if($album->type == 0)
                                                                <img
                                                                    src="{{ asset($album->image) }}"
                                                                    alt="آلبوم {{ $album->name }}"
                                                                    loading="lazy"
                                                                    decoding="async"
                                                                >
                                                            @else
                                                                <video
                                                                    class="d-flex align-items-center justify-content-center"
                                                                    src="{{ asset($album->video) }}"
                                                                    controls
                                                                ></video>
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
    <!-- end product lazy load (albums) -->

    <!-- start videos -->
    @if($videos->count() > 0)
        <section class="mb-3">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start content header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>ویدیو محصولات</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="{{ route('content.videos') }}">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- end content header -->

                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme" aria-label="ویدیوهای محصولات">
                                    @foreach($videos as $video)
                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section>
                                                    {!! $video->link !!}
                                                    <section class="video-name">
                                                        <h3>
                                                            <a class="text-dark" href="{{ url($video->url) }}">
                                                                {{ $video->title }}
                                                            </a>
                                                        </h3>
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

    <!-- start most viewed products -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a class="product-link" href="{{ route('market.products', ['sort' => 5]) }}">
                                        مشاهده همه
                                    </a>
                                </section>
                            </section>
                        </section>

                        @include('app.layouts.products', ['products' => $mostViewedProducts])
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end most viewed products -->

    <!-- start ads section (top ads icons) -->
    @if($topAds->count() > 0)
        <section class="mb-3 bg-gray">
            <section class="container-xxl">
                <section class="row py-4 d-flex justify-content-center">
                    @foreach($topAds as $ad)
                        <section class="col-2">
                            <a href="{{ url($ad->url) }}">
                                <img
                                    class="d-block rounded-2 w-100"
                                    src="{{ $ad->image }}"
                                    alt="بنر تبلیغاتی - {{ $ad->title }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </a>
                        </section>
                    @endforeach
                </section>
            </section>
        </section>
    @endif
    <!-- end ads section -->

    <!-- start best sales products -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پر فروش ترین کالا ها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{ route('market.products', ['sort' => 6]) }}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>

                        @include('app.layouts.products', ['products' => $bestSalesProducts])
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end best sales products -->

    <!-- start bottom banner -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row py-4">
                <section class="col">
                    <span class="w-100 d-block h-auto text-decoration-none">
                        <img
                            class="d-block rounded-2 w-100"
                            src="{{ $bottomBanner->image }}"
                            alt="بنر وسط صفحه - {{ $bottomBanner->title }}"
                            loading="lazy"
                            decoding="async"
                        >
                    </span>
                </section>
            </section>
        </section>
    </section>
    <!-- end bottom banner -->

    <!-- start offer products -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد بوتیکالا به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{ route('market.products') }}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>

                        @include('app.layouts.products', ['products' => $offerProducts])
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end offer products -->

    <!-- start ads section (middle small ads) -->
    <section class="mb-3 bg-gray">
        <section class="container-xxl">
            <section class="row py-4 d-flex justify-content-center">
                @foreach($ads as $ad)
                    <section class="col-2">
                        <a href="{{ url($ad->url) }}">
                            <img
                                class="d-block rounded-2 w-100"
                                src="{{ $ad->image }}"
                                alt="تبلیغ ویژه - {{ $ad->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end ads section -->

    <!-- start new products -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>جدیدترین کالا ها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{ route('market.products', ['sort' => 1]) }}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>

                        @include('app.layouts.products', ['products' => $newProducts])
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end new products -->

    <!-- start middle banners -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row py-4">
                @foreach($middleBanners as $middleBanner)
                    <section class="col-12 col-md-6 mt-2 mt-md-0">
                        <a href="{{ $middleBanner->url }}">
                            <img
                                class="d-block rounded-2 w-100"
                                src="{{ asset($middleBanner->image) }}"
                                alt="بنر میانی - {{ $middleBanner->title }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end middle banners -->

    <!-- start latest posts -->
    <section class="brand-part mb-4 py-4">
        <section class="container-xl">
            <section class="row">
                <section class="col">
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>آخرین مقالات</span>
                            </h2>
                            <section class="content-header-link">
                                <a href="{{ route('content.posts') }}">مشاهده همه</a>
                            </section>
                        </section>
                    </section>

                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme" aria-label="آخرین مقالات بوتیکالا">
                            @foreach($posts as $post)
                                <section class="item border">
                                    <section class="brand-item mt-3">
                                        <a href="{{ route('content.post', $post) }}">
                                            <img
                                                class="rounded-2"
                                                src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                                alt="مقاله: {{ $post->title }}"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                        </a>
                                    </section>
                                    <section class="brand-item my-3">
                                        <a class="text-dark" href="{{ route('content.post', $post) }}">
                                            {{ $post->title }}
                                        </a>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end latest posts -->

    <!-- start special brands -->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>

                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme" aria-label="برندهای ویژه بوتیکالا">
                            @foreach($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        <img
                                            class="rounded-2"
                                            src="{{ asset($brand->logo['indexArray'][$brand->logo['currentImage']]) }}"
                                            alt="برند {{ $brand->persian_name }}"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end special brands -->
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

@extends('app.layouts.master-one-col')

@section('head-tag')

    @php
        use Illuminate\Support\Str;

        // توضیح کوتاه برای سئو و اسکیما (بدون تگ‌های HTML)
        $postDescription = Str::limit(strip_tags($post->body), 160, '');
    @endphp

    {{-- متاهای اصلی سئو و اشتراک‌گذاری --}}
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:description" content="{{ $postDescription }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:image"
          content="{{ asset(str_replace('\\','/',$post->image['indexArray'][$post->image['currentImage']])) }}">

    <meta name="description" content="{{ $postDescription }}">
    <meta name="keywords" content="{{ $post->tags }}">
    <title>{{ $post->title }} | وبلاگ بوتیکالا</title>

    {{-- اسکیما: مقاله وبلاگ --}}
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": @json($post->title),
  "description": @json($postDescription),
  "image": [
    "{{ asset(str_replace('\\','/',$post->image['indexArray'][$post->image['currentImage']])) }}"
  ],
  "author": {
    "@type": "Organization",
    "name": "بوتیکالا"
  },
  "publisher": {
    "@type": "Organization",
    "name": "بوتیکالا",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset(str_replace('\\','/',$setting->logo ?? '')) }}"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  },
  "datePublished": "{{ optional($post->created_at)->toIso8601String() }}",
  "dateModified": "{{ optional($post->updated_at ?? $post->created_at)->toIso8601String() }}",
  "keywords": @json($post->tags),
  "articleSection": "blog"
}
    </script>

    {{-- اسکیما: بردکرامب برای پست --}}
    <script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "BreadcrumbList",
 "itemListElement": [
   {
     "@type": "ListItem",
     "position": 1,
     "name": "صفحه اصلی",
     "item": "{{ route('home') }}"
   },
   {
     "@type": "ListItem",
     "position": 2,
     "name": "وبلاگ",
     "item": "{{ route('content.posts') }}"
   },
   {
     "@type": "ListItem",
     "position": 3,
     "name": @json($post->title),
     "item": "{{ url()->current() }}"
   }
 ]
}
    </script>

@endsection


@section('content')
    <!-- start post -->
    <section class="mb-4">
        <section class="container-xxl">

            {{-- بردکرامب --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item font-size-12">
                        <a class="text-decoration-none text-dark" href="{{ route('home') }}">صفحه اصلی</a>
                    </li>
                    <li class="breadcrumb-item font-size-12">
                        <a class="text-decoration-none text-dark" href="{{ route('content.posts') }}">وبلاگ</a>
                    </li>
                    <li class="breadcrumb-item font-size-12">
                        <a class="text-decoration-none text-dark" href="{{ url()->current() }}">پست</a>
                    </li>
                    <li class="breadcrumb-item font-size-12 active d-none" aria-current="page">
                        {{ $post->title }}
                    </li>
                </ol>
            </nav>

            <section class="row">
                <section class="col">

                    {{-- عنوان پست --}}
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h1 class="content-header-title">
                                <span>{{ $post->title }}</span>
                            </h1>
                            <section class="content-header-link">
                                {{-- لینک اضافی اگر لازم شد --}}
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">

                        {{-- ستون تصویر و تگ‌ها --}}
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">
                                    <section class="product-gallery-selected-image mb-3">
                                        <img
                                            src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                            alt="{{ $post->title }}">
                                    </section>

                                    <section class="my-4">
                                        <i class="fa fa-tags"></i>
                                        <span>برچسب‌ها :
                                            {{ $post->tags ?: '-' }}
                                        </span>
                                    </section>
                                </section>
                            </section>
                        </section>

                        {{-- ستون متن پست --}}
                        <section class="col-md-8">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{ $post->title }}
                                        </h2>
                                        <section class="content-header-link">
                                            {{-- لینک اضافی در صورت نیاز --}}
                                        </section>
                                    </section>
                                </section>

                                <section class="product-info">
                                    <section id="desc">
                                        {!! $post->body !!}
                                    </section>
                                </section>
                            </section>
                        </section>

                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end post -->


    <!-- start comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">

                        {{-- هدر بخش دیدگاه‌ها (استیکی مثل محصول) --}}
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2">
                                            <a class="text-decoration-none text-dark" href="#comments">دیدگاه‌ها</a>
                                        </span>
                                    </h2>
                                    <section class="content-header-link">
                                        {{-- لینک اضافی در صورت نیاز --}}
                                    </section>
                                </section>
                            </section>
                        </section>

                        <section class="py-4">

                            {{-- عنوان بخش دیدگاه‌ها --}}
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه‌ها
                                    </h2>
                                    <section class="content-header-link">
                                        {{-- لینک اضافی در صورت نیاز --}}
                                    </section>
                                </section>
                            </section>

                            <section class="product-comments mb-4">

                                {{-- اگر لاگین نیست --}}
                                @guest
                                    <section class="comment-add-wrapper">
                                        <p>برای افزودن دیدگاه وارد حساب کاربری خود شوید</p>
                                        <a href="{{ route('auth.customer.login-register-form') }}"
                                           class="btn btn-primary">
                                            ورود یا ثبت‌نام
                                        </a>
                                    </section>
                                @endguest

                                {{-- اگر لاگین است --}}
                                @auth
                                    <section class="comment-add-wrapper">
                                        <button class="comment-add-button"
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#add-comment">
                                            <i class="fa fa-plus"></i> افزودن دیدگاه
                                        </button>

                                        {{-- Modal افزودن دیدگاه --}}
                                        <section class="modal fade" id="add-comment" tabindex="-1"
                                                 aria-labelledby="add-comment-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">

                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-comment-label">
                                                            <i class="fa fa-plus"></i> افزودن دیدگاه
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </section>

                                                    <section class="modal-body">
                                                        <form class="row"
                                                              action="{{ route('content.post.store-comment', $post) }}"
                                                              method="post">
                                                            @csrf

                                                            <section class="col-12 mb-2">
                                                                <label for="comment" class="form-label mb-1">
                                                                    دیدگاه شما
                                                                </label>
                                                                <textarea
                                                                    class="form-control form-control-sm"
                                                                    id="comment"
                                                                    placeholder="دیدگاه شما ..."
                                                                    rows="4"
                                                                    name="body"></textarea>

                                                                @error('body')
                                                                <span class="text-danger">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </section>

                                                            <section class="modal-footer py-1">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-primary">
                                                                    ثبت دیدگاه
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                    بستن
                                                                </button>
                                                            </section>
                                                        </form>
                                                    </section>

                                                </section>
                                            </section>
                                        </section>
                                    </section>
                                @endauth

                                {{-- لیست دیدگاه‌ها --}}
                                @foreach($post->approvedComments() as $comment)
                                    <section class="product-comment">

                                        <section class="product-comment-header d-flex justify-content-start">
                                            <section class="product-comment-date">
                                                {{ jalaliDate($comment->created_at) }}
                                            </section>
                                            <section class="product-comment-title">
                                                {{ $comment->user->full_name ?? 'ناشناس' }}
                                            </section>
                                        </section>

                                        <section class="product-comment-body">
                                            {{ $comment->body }}
                                        </section>

                                        {{-- پاسخ ادمین --}}
                                        @if(!empty($comment->answer))
                                            <section class="product-comment ms-5 border-bottom-0">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-date">
                                                        {{ jalaliDate($comment->answer->created_at) }}
                                                    </section>
                                                    <section class="product-comment-title">
                                                        ادمین
                                                    </section>
                                                </section>
                                                <section class="product-comment-body">
                                                    {{ $comment->answer->body }}
                                                </section>
                                            </section>
                                        @endif

                                    </section>
                                @endforeach

                            </section>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end comments -->
@endsection


@section('scripts')
    <script>
        // استیکی شدن هدر بخش دیدگاه‌ها (همون رفتار قبلی روی #introduction-features-comments)
        $(document).ready(function () {
            var $block = $("#introduction-features-comments");
            if (!$block.length) return;

            var pos = $block.position();
            $(window).on('scroll', function () {
                var windowTop = $(this).scrollTop();

                if (windowTop >= pos.top) {
                    $block.addClass("stick");
                } else {
                    $block.removeClass("stick");
                }
            });
        });
    </script>
@endsection

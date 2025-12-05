@extends('app.layouts.master-one-col')

@section('head-tag')

    @php
        use Illuminate\Support\Str;
        $blogDescription = Str::limit(strip_tags($setting->description), 160, '');
    @endphp

    {{-- OG --}}
    <meta property="og:title" content="وبلاگ بوتیکالا"/>
    <meta property="og:description" content="{{ $blogDescription }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:image" content="{{ asset(str_replace('\\','/',$setting->logo)) }}"/>

    {{-- META --}}
    <meta name="description" content="{{ $blogDescription }}">
    <meta name="keywords" content="{{ $setting->keywords }}">
    <title>وبلاگ بوتیکالا</title>

    {{-- ✔️ اسکیما: صفحه آرشیو وبلاگ --}}
    <script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "CollectionPage",
 "name": "وبلاگ بوتیکالا",
 "description": @json($blogDescription),
 "url": "{{ url()->current() }}",
 "image": "{{ asset(str_replace('\\','/',$setting->logo)) }}",
 "hasPart": {
    "@type": "Blog",
    "name": "مقالات بوتیکالا",
    "publisher": {
        "@type": "Organization",
        "name": "بوتیکالا",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset(str_replace('\\','/',$setting->logo)) }}"
        }
    }
 },
 "mainEntity": {
    "@type": "ItemList",
    "itemListElement": [
        @foreach($posts as $index => $post)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "url": "{{ route('content.post', $post) }}",
                "name": @json($post->title)
            }@if(!$loop->last),@endif
        @endforeach
        ]
     }
    }
</script>

@endsection


@section('content')
    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item font-size-12">
                    <a class="text-decoration-none text-dark" href="{{ route('home') }}">صفحه اصلی</a>
                </li>
                <li class="breadcrumb-item font-size-12 active" aria-current="page">
                    <a class="text-decoration-none text-dark" href="{{ url()->current() }}">وبلاگ</a>
                </li>
            </ol>
        </nav>

        {{-- Posts --}}
        <section class="row my-4 d-flex justify-content-center">

            <section class="row d-flex justify-content-center">

                @forelse($posts as $post)
                    <section class="col-md-2 m-1">
                        <section class="product">

                            <a class="product-link d-flex flex-column justify-content-center"
                               href="{{ route('content.post', $post) }}">

                                <section class="product-image">
                                    <img
                                        src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                        alt="خواندن {{ $post->title }} در وبلاگ بوتیکالا">
                                </section>

                                <section class="product-name">
                                    <h2 class="d-flex justify-content-center">{{ $post->title }}</h2>
                                </section>

                            </a>

                        </section>
                    </section>

                @empty
                    <p>پستی یافت نشد</p>
                @endforelse

            </section>

            {{-- Pagination --}}
            <section class="my-4 d-flex justify-content-center border-0">
                {{ $posts->links('pagination::custom') }}
            </section>

        </section>

    </section>
@endsection

@extends('app.layouts.master-one-col')

@section('head-tag')

    @php
        use Illuminate\Support\Str;
        $pageDescription = Str::limit(strip_tags($setting->description), 160, '');
    @endphp

    {{-- OG --}}
    <meta property="og:title" content="ویدیو محصولات بوتیکالا"/>
    <meta property="og:description" content="{{ $pageDescription }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:image" content="{{ asset(str_replace('\\','/',$setting->logo)) }}"/>

    {{-- META --}}
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $setting->keywords }}">
    <title>ویدیو محصولات</title>

    {{-- ✔ اسکیما مخصوص صفحه ویدیوها --}}
    <script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "CollectionPage",
 "name": "ویدیو محصولات بوتیکالا",
 "description": @json($pageDescription),
 "url": "{{ url()->current() }}",
 "image": "{{ asset(str_replace('\\','/',$setting->logo)) }}",

 "mainEntity": {
    "@type": "ItemList",
    "itemListElement": [
        @foreach($videos as $i => $video)
            {
                "@type": "ListItem",
                "position": {{ $i+1 }},
            "url": "{{ url($video->url) }}",
            "name": @json($video->title),
            "item": {
                "@type": "VideoObject",
                "name": @json($video->title),
                "description": @json(Str::limit(strip_tags($video->title), 120)),
                "uploadDate": "{{ optional($video->created_at)->format('Y-m-d') }}",
                "thumbnailUrl": "{{ asset(str_replace('\\','/',$setting->logo)) }}"
            }
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
                    <a class="text-decoration-none text-dark" href="{{ url()->current() }}">ویدیو محصولات</a>
                </li>
            </ol>
        </nav>

        <section class="row my-4 d-flex justify-content-center">

            <section class="row d-flex justify-content-center">

                @forelse($videos as $video)
                    <section class="col-md-2 m-1">

                        <section class="video-wrapper">

                            {{-- ویدیو Embed --}}
                            {!! $video->link !!}

                            {{-- عنوان ویدیو --}}
                            <section class="video-name mt-2 text-center">
                                <h3 style="font-size: 15px;">
                                    <a class="text-dark text-decoration-none" href="{{ url($video->url) }}">
                                        {{ $video->title }}
                                    </a>
                                </h3>
                            </section>

                        </section>

                    </section>

                @empty
                    <p>ویدیویی یافت نشد</p>
                @endforelse

            </section>

            {{-- Pagination --}}
            <section class="my-4 d-flex justify-content-center border-0">
                {{ $videos->links('pagination::custom') }}
            </section>

        </section>

    </section>
@endsection

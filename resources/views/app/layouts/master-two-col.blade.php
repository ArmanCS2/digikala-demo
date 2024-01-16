<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('app.layouts.head-tag')
    @yield('head-tag')
</head>
<body>


@include('app.layouts.header')

<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
            @include('app.layouts.sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                    @yield('content')
                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->


@include('app.layouts.footer')


@include('app.layouts.scripts')
@yield('scripts')
</body>
</html>

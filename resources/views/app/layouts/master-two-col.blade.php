<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('app.layouts.head-tag')
    @yield('head-tag')
</head>
<body>


@include('app.layouts.header')

<section class="container-xxl body-container">
    @include('app.layouts.sidebar')
</section>
<!-- start main one col -->
<main id="main-body-one-col" class="main-body">

    @yield('content')

</main>
<!-- end main one col -->


<!-- start body -->
<section class="container-xxl body-container">
    <aside id="sidebar" class="sidebar">

    </aside>
    <main id="main-body" class="main-body">

    </main>
</section>
<!-- end body -->


@include('app.layouts.footer')


@include('app.layouts.scripts')
@yield('scripts')
</body>
</html>

<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @livewireStyles
    @include('app.layouts.head-tag')
    @yield('head-tag')
</head>
<body>


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

@livewireScripts
@include('app.layouts.scripts')
@yield('scripts')


@include('alerts.toast.success')
@include('alerts.toast.error')
@include('alerts.toast.info')


@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm',['className'=>'delete'])
</body>
</html>

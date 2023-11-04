<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>

<body dir="rtl">


@include('admin.layouts.header')

<section class="body-container">
    @include('admin.layouts.sidebar')
    <section id="main-body" class="main-body">
        @yield('content')
    </section>
</section>


@include('admin.layouts.scripts')
@yield('scripts')

<section class="toast-wrapper flex-row-reverse">
    @include('alerts.toast.success')
    @include('alerts.toast.error')
    @include('alerts.toast.info')
</section>

@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm',['className'=>'delete'])
</body>

</html>

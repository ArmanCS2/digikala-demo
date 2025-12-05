<!doctype html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    {{-- Global Head --}}
    @include('app.layouts.head-tag')

    {{-- Page-specific Head --}}
    @yield('head-tag')

    {{-- Livewire Styles --}}
    @livewireStyles

</head>

<body>

{{-- Header --}}
@include('app.layouts.header')


<!-- START TWO COLUMN LAYOUT -->
<section id="main-body-two-col" class="container-xxl body-container">

    <section class="row">

        {{-- Sidebar --}}
        @include('app.layouts.sidebar')

        {{-- Main Content --}}
        <main id="main-body" class="main-body col-md-9">

            <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                @yield('content')
            </section>

        </main>

    </section>

</section>
<!-- END TWO COLUMN LAYOUT -->


{{-- Footer --}}
@include('app.layouts.footer')


{{-- Livewire Scripts --}}
@livewireScripts

{{-- Global Scripts --}}
@include('app.layouts.scripts')

{{-- Page Scripts --}}
@yield('scripts')


<!-- Toast Wrapper -->
<section class="toast-wrapper flex-row-reverse d-none"></section>

{{-- Toast Messages --}}
@include('alerts.toast.success')
@include('alerts.toast.error')
@include('alerts.toast.info')

{{-- SweetAlerts --}}
@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm',['className'=>'delete'])

</body>
</html>

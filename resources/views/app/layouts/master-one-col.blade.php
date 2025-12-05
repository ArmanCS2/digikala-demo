<!doctype html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    {{-- Head Global --}}
    @include('app.layouts.head-tag')

    {{-- Head Dynamic --}}
    @yield('head-tag')

    {{-- Livewire Styles --}}
    @livewireStyles

</head>


<body>

@include('app.layouts.header')


<!-- START MAIN CONTENT WRAPPER -->
<main id="main-body" class="main-body">

    {{-- Page Content --}}
    @yield('content')

</main>
<!-- END MAIN CONTENT WRAPPER -->


@include('app.layouts.footer')


{{-- Livewire --}}
@livewireScripts


{{-- Global Scripts --}}
@include('app.layouts.scripts')

{{-- Page Scripts --}}
@yield('scripts')


<!-- Toasts -->
<section class="toast-wrapper flex-row-reverse d-none"></section>
@include('alerts.toast.success')
@include('alerts.toast.error')
@include('alerts.toast.info')

<!-- SweetAlerts -->
@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm', ['className' => 'delete'])

</body>
</html>

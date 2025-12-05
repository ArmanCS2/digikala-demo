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

<!-- START MAIN CONTAINER -->
<main id="main-body-one-col" class="main-body">

    {{-- Page Content --}}
    @yield('content')

</main>
<!-- END MAIN CONTAINER -->


<!-- SECONDARY LAYOUT (kept for UI compatibility, not as <main>) -->
<section class="container-xxl body-container">
    <aside id="sidebar" class="sidebar">
        {{-- Reserved for sidebar content --}}
    </aside>

    <section id="main-body" class="main-body">
        {{-- Reserved for two-column layout pages --}}
    </section>
</section>


{{-- Livewire Scripts --}}
@livewireScripts

{{-- Global Scripts --}}
@include('app.layouts.scripts')

{{-- Page Scripts --}}
@yield('scripts')


<!-- Toasts -->
@include('alerts.toast.success')
@include('alerts.toast.error')
@include('alerts.toast.info')

<!-- SweetAlerts -->
@include('alerts.sweetalert.success')
@include('alerts.sweetalert.error')
@include('alerts.sweetalert.delete-confirm', ['className' => 'delete'])

</body>
</html>

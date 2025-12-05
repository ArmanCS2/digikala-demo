@extends('app.layouts.master-simple')

@section('head-tag')

    <title>ورود / عضویت | بوتیکالا</title>

    {{-- جلوگیری از ایندکس صفحه لاگین --}}
    <meta name="robots" content="noindex, nofollow">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Recaptcha --}}
    {!! htmlScriptTagJsApi() !!}
@endsection


@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">

        <form action="{{ route('auth.customer.login-register') }}" method="post" autocomplete="on">
            @csrf

            <section class="login-wrapper mb-5">

                {{-- لوگو --}}
                <section class="login-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($setting->logo) }}" alt="ورود به بوتیکالا" title="بوتیکالا">
                    </a>
                </section>

                {{-- عنوان --}}
                <section class="login-title">ورود / ثبت‌نام</section>

                {{-- ورودی شماره موبایل / ایمیل --}}
                <section class="my-2">
                    <section class="login-info">شماره موبایل یا ایمیل خود را وارد کنید</section>

                    <section class="login-input-text">
                        <input type="tel"
                               name="id"
                               placeholder="09xxxxxxxxx"
                               autocomplete="username"
                               inputmode="numeric">
                    </section>

                    @error('id')
                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </section>

                {{-- دکمه --}}
                <section class="login-btn d-grid g-2 my-1">
                    <button class="btn btn-primary">ادامه</button>
                </section>

            </section>
        </form>

    </section>
@endsection

@extends('app.layouts.master-simple')

@section('head-tag')
    <title>ورود - عضویت</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{route('auth.customer.login-register')}}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{asset($setting->logo)}}" alt="">
                </section>
                <section class="login-title">ورود / ثبت نام</section>
                <section class="login-info">شماره موبایل یا پست الکترونیک خود را وارد کنید</section>
                <section class="login-input-text">
                    <input type="text" name="id">
                </section>
                @error('id')
                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                @enderror
                <section class="login-btn d-grid g-2 my-1">
                    <button class="btn btn-danger">ورود</button>
                </section>
                <section class="login-terms-and-conditions my-1"><a href="#">شرایط و قوانین</a> را خوانده ام و پذیرفته ام
                </section>
                <section class="my-2">
                    {!! htmlFormSnippet() !!}
                    @error('g-recaptcha-response')
                    <span class="text-danger">
                                    <strong>خطا در اعتبارسنجی recapcha</strong>
                                </span>
                    @enderror
                </section>


            </section>
        </form>

    </section>

@endsection

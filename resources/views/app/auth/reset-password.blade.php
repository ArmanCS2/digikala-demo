@extends('app.layouts.master-simple')

@section('head-tag')
    <title>تغییر رمز عبور</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{route('auth.reset-password',request()->token)}}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <a href="{{route('home')}}"><img src="{{asset($setting->logo)}}" alt=""></a>
                </section>
                <section class="login-title">تغییر رمز عبور</section>

                <section class="my-2">
                    <section class="login-info">رمز عبور جدید</section>
                    <section class="login-input-text">
                        <input type="password" name="password">
                    </section>
                    @error('password')
                    <span class="text-danger">
                                    <span class="small">{{$message}}</span>
                                </span>
                    @enderror
                </section>

                <section class="my-2">
                    <section class="login-info">تایید رمز عبور جدید</section>
                    <section class="login-input-text">
                        <input type="password" name="password_confirmation">
                    </section>
                    @error('password_confirmation')
                    <span class="text-danger">
                                    <span class="small">{{$message}}</span>
                                </span>
                    @enderror
                </section>


                <section class="login-btn d-grid g-2 my-1">
                    <button class="btn btn-danger">تغییر رمز عبور</button>
                </section>


                {{--                <section class="login-terms-and-conditions my-1"><a href="#">شرایط و قوانین</a> را خوانده ام و پذیرفته ام--}}
                {{--                </section>--}}
                {{--                <section class="my-2">--}}
                {{--                    {!! htmlFormSnippet() !!}--}}
                {{--                    @error('g-recaptcha-response')--}}
                {{--                    <span class="text-danger">--}}
                {{--                                    <strong>خطا در اعتبارسنجی recapcha</strong>--}}
                {{--                                </span>--}}
                {{--                    @enderror--}}
                {{--                </section>--}}


            </section>
        </form>

    </section>

@endsection

@extends('app.layouts.master-simple')

@section('head-tag')
    <title>کد تایید</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        #resend-otp {
            font-size: 1rem;
        }

        #timer {
            font-size: 0.75rem;
        }
    </style>

@endsection

@section('content')


    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-confirm', $token) }}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <a href="{{route('home')}}"><img src="{{asset($setting->logo)}}" alt=""></a>
                </section>
                <section class="login-title mb-2">
                    <a href="{{ route('auth.customer.login-register-form') }}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </section>
                <section class="my-2">
                    <section class="login-title">
                        کد تایید را وارد نمایید
                    </section>

                    @if($otp->type == 0)
                        <section class="login-info">
                            کد تایید برای شماره موبایل {{ $otp->login_id }} ارسال گردید
                        </section>
                    @else
                        <section class="login-info">
                            کد تایید برای ایمیل {{ $otp->login_id }} ارسال گردید
                        </section>
                    @endif
                    <section class="login-input-text">
                        <input type="text" name="otp" value="">
                        @error('otp')
                        <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                        @enderror
                    </section>
                </section>
                <section class="login-btn d-grid g-2">
                    <button class="btn btn-primary">تایید</button>
                </section>

                <section id="resend-otp" class="d-none text-center">
                    <a href="{{route('auth.customer.login-resend-otp',$token)}}"
                       class="text-decoration-none text-primary">دریافت مجدد کد تایید</a>
                </section>
                <section id="timer" class="text-center text-danger"></section>

                <section class="text-center">
                    <a href="{{route('auth.customer.login-register-form')}}"
                       class="text-decoration-none text-primary small">در صورت عدم دریافت اس ام اس با ایمیل وارد
                        شوید</a>
                </section>

            </section>
        </form>
    </section>


@endsection


@section('scripts')

    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(1)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>

        var countDownDate = new Date().getTime() + {{ $timer }};
        var timer = $('#timer');
        var resendOtp = $('#resend-otp');

        var x = setInterval(function () {

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (minutes == 0) {
                timer.html('ارسال مجدد کد تایید تا ' + seconds + ' ثانیه دیگر')
            } else {
                timer.html('ارسال مجدد کد تایید تا ' + minutes + ' دقیقه و ' + seconds + ' ثانیه دیگر');
            }
            if (distance < 0) {
                clearInterval(x);
                timer.addClass('d-none');
                resendOtp.removeClass('d-none');
            }

        }, 1000)


    </script>

@endsection


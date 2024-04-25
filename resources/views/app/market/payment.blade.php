@extends('app.layouts.master-one-col')

@section('head-tag')
    <title>صفحه پرداخت</title>
@endsection


@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>انتخاب نوع پرداخت </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            کد تخفیف
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                         role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        کد تخفیف خود را در این بخش وارد کنید.
                                    </secrion>
                                </section>

                                <section class="row">
                                    <section class="col-md-5">
                                        <form action="{{route('market.payment.copan-discount')}}" method="post">
                                            @csrf
                                            <section class="input-group input-group-sm">

                                                <input type="text" name="copan" class="form-control"
                                                       placeholder="کد تخفیف را وارد کنید">
                                                <button class="btn btn-primary" type="submit">اعمال کد</button>

                                            </section>
                                        </form>
                                    </section>

                                </section>
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نوع پرداخت
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="payment-select">

                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2"
                                             role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            روش پرداخت را انتخاب کنید
                                        </secrion>
                                    </section>

                                    <form action="{{route('market.payment.type')}}" method="post" id="payment_type">
                                        @csrf
                                        <input checked type="radio" name="payment_type" value="1" id="d1"/>
                                        <label for="d1" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-credit-card mx-1"></i>
                                                پرداخت آنلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                درگاه پرداخت زرین پال
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="2" id="d2"/>
                                        <label for="d2" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-id-card-alt mx-1"></i>
                                                پرداخت آفلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                حداکثر در 2 روز کاری بررسی می شود
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="3" id="cash_payment"/>
                                        <label for="cash_payment" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-money-check mx-1"></i>
                                                پرداخت در محل
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                پرداخت به پیک هنگام دریافت کالا
                                            </section>
                                        </label>

                                    </form>


                                </section>
                            </section>


                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">

                                @include('app.layouts.prices',['order'=>$order])

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">هزینه ارسال</p>
                                    <p class="text-warning">{{priceFormat($order->delivery_object->amount ?? 0)}} تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                    انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold">{{priceFormat($order->total_price)}}
                                        تومان</p>
                                </section>

                                <section class="">
                                    {{--                                    <section id="payment-button"--}}
                                    {{--                                             class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">--}}
                                    {{--                                        روش پرداخت را انتخاب کنید--}}
                                    {{--                                    </section>--}}
                                    <button onclick="document.getElementById('payment_type').submit()"
                                            class="btn btn-danger w-100">ثبت سفارش و
                                        گرفتن کد رهگیری
                                    </button>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
@endsection

@section('scripts')
    <script>
        /*$(function () {
            $('#cash_payment').click(function(){
                var newDiv = document.createElement('div');
                newDiv.innerHTML = `
                <section class="input-group input-group-sm">
                    <input type="text" name="cash_receiver" class="form-control" form="payment_type" placeholder="نام و نام خانوادگی دریافت کننده" >
                </section>
                `;
                document.getElementsByClassName('content-wrapper')[1].appendChild(newDiv)
            })
        })*/
    </script>


@endsection




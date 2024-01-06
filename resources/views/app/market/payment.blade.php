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

                                    <input type="radio" name="payment_type" value="1" id="d1"/>
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

                                    <input type="radio" name="payment_type" value="3" id="d3"/>
                                    <label for="d3" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-money-check mx-1"></i>
                                            پرداخت در محل
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            پرداخت به پیک هنگام دریافت کالا
                                        </section>
                                    </label>


                                </section>
                            </section>


                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{priceFormat($cartItems->count())}})</p>
                                    <p class="text-muted">{{priceFormat($productPrices)}} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder">{{priceFormat($order->order_discount_amount ?? 0)}}
                                        تومان</p>
                                </section>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder">{{priceFormat($totalProductPrices)}} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">هزینه ارسال</p>
                                    <p class="text-warning">{{priceFormat($order->delivery->amount ?? 0)}} تومان</p>
                                </section>

                                @if(!empty($order->commonDiscount))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف عمومی اعمال شده</p>
                                        <p class="text-danger">{{priceFormat($order->order_common_discount_amount)}}
                                            تومان</p>
                                    </section>
                                @endif

                                @if(!empty($order->copan))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">کد تخفیف اعمال شده</p>
                                        <p class="text-danger">{{priceFormat($order->order_copan_discount_amount)}}
                                            تومان</p>
                                    </section>
                                @endif

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                    انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold">{{priceFormat($order->order_final_amount + ($order->delivery_amount ??0 ))}}
                                        تومان</p>
                                </section>

                                <section class="">
                                    <section id="payment-button"
                                             class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">
                                        روش پرداخت را انتخاب کنید
                                    </section>
                                    <a id="final-level" href="my-orders.html" class="btn btn-danger d-none">ثبت سفارش و
                                        گرفتن کد رهگیری</a>
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
        $(document).ready(function () {
            $('#province').change(function () {
                var element = $('#province option:selected');
                var url = element.attr('data-url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            let cities = response.cities;
                            $('#city').empty();
                            cities.map((city) => {
                                $('#city').append($('<option/>').val(city.id).text(city.title));
                            });

                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            });


            //edit-address
            var addresses = {!! auth()->user()->addresses !!};
            addresses.map(function (address) {
                var id = address.id;
                var target = '#province-' + id;
                var selected = target + ' option:selected';
                $(target).change(function () {
                    var element = $(selected);
                    var url = element.attr('data-url');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            if (response.status) {
                                let cities = response.cities;
                                $('#city-' + id).empty();
                                cities.map((city) => {
                                    $('#city-' + id).append($('<option/>').val(city.id).text(city.title));
                                });

                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                });
            });


        })
    </script>


@endsection




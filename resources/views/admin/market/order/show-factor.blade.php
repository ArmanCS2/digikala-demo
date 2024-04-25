@extends('admin.layouts.master')

@section('head-tag')
    <title>فاکتور سفارش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فاکتور</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فاکتور
                    </h5>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px" id="printable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="table-active">
                            <th> شماره سفارش : {{'BK-' .  $order->id }}</th>
                            <td class="width-8-rem text-left">
                                <a href="" class="btn btn-dark btn-sm text-white" id="print">
                                    <i class="fa fa-print"></i>
                                    چاپ
                                </a>
                                <a href="{{route('admin.market.order.show-detail',[$order->id])}}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fa fa-book"></i>
                                    جزئیات
                                </a>
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>نام مشتری</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->user->full_name ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>استان</th>
                            <td class="text-left font-weight-bolder">
                                {{ \App\Models\Market\ProvinceCity::find($order->address_object->province_id)->title ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>شهر</th>
                            <td class="text-left font-weight-bolder">
                                {{ \App\Models\Market\ProvinceCity::find($order->address_object->city_id)->title ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>آدرس</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->address ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>کد پستی</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->postal_code ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>پلاک</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->no ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>واحد</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->unit ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نام و نام خانوادگی گیرنده</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->recipient_first_name . ' ' .$order->address_object->recipient_last_name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>موبایل</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address_object->mobile ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نوع پرداخت</th>
                            <td class="text-left font-weight-bolder">
                                {{$order->payment_type()}}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت پرداخت</th>
                            <td class="text-left font-weight-bolder">
                                {{$order->payment_status()}}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع قیمت ها</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->final_price) ?? 0 }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع تخفیف ها</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->final_discount) ?? 0 }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>تخفیف کلی سایت</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->common_discount_amount) ??0}}
                                تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ کد تخفیف</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->copan_discount_amount) ?? 0}} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ ارسال</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->delivery_amount) ?? 0 }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ نهایی</th>
                            <td class="text-left font-weight-bolder">
                                {{ number_format($order->total_price) ?? 0}} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>بانک</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->payment_object->paymentable->gateway ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>وضعیت سفارش</th>
                            <td class="text-left font-weight-bolder">
                                {{$order->order_status()}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>کد رهگیری سفارش</th>
                            <td class="text-left font-weight-bolder">
                                {{$order->tracking_code ?? '-'}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>وضعیت ارسال</th>
                            <td class="text-left font-weight-bolder">
                                {{$order->delivery_status()}}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection


@section('scripts')

    <script>

        var printBtn = document.getElementById('print');
        printBtn.addEventListener('click', function () {
            printContent('printable');
        });


        function printContent(el) {

            var restorePage = $('body').html();
            var printContent = $('#' + el).clone();
            $('body').empty().html(printContent);
            window.print();
            $('body').html(restorePage);
        }


    </script>

@endsection

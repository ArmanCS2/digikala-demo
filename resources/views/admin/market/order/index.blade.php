@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        سفارشات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover" style="height: 135px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد سفارش</th>
                            <th>مجموع قیمت ها</th>
                            <th>مجموع تخفیف ها</th>
                            <th>تخفیف کلی سایت</th>
                            <th>مبلغ کد تخفیف</th>
                            <th>مبلغ ارسال</th>
                            <th>مبلغ نهایی</th>
                            <th>وضعیت پرداخت</th>
                            <th>شیوه پرداخت</th>
                            <th>بانک</th>
                            <th>وضعیت ارسال</th>
                            <th>شیوه ارسال</th>
                            <th>وضعیت سفارش</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $order)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{'BK-' . $order->id}}</td>
                                <td>{{number_format($order->final_price)}} تومان</td>
                                <td>{{number_format($order->final_discount)}} تومان</td>
                                <td>{{number_format($order->common_discount_amount)}} تومان</td>
                                <td>{{number_format($order->copan_discount_amount )}}
                                    تومان
                                </td>
                                <td>{{number_format($order->delivery_amount )}}
                                    تومان
                                </td>
                                <td>{{number_format($order->total_price )}}
                                    تومان
                                </td>
                                <td>{{$order->payment_status()}}</td>
                                <td>{{$order->payment_type()}}</td>
                                <td>{{$order->payment->paymentable->gateway ?? '-'}}</td>
                                <td>{{$order->delivery_status()}}</td>
                                <td>{{$order->delivery_object->name}}</td>
                                <td>{{$order->order_status()}}</td>
                                <td class="width-16-rem text-left">
                                    <div>
                                        <a href="{{route('admin.market.order.edit',$order)}}"
                                           class="dropdown-item text-right"><i class="fa fa-edit"></i>ویرایش
                                            سفارش</a>
                                        <a href="{{route('admin.market.order.show-detail',[$order->id])}}"
                                           class="dropdown-item text-right"><i class="fa fa-eye"></i> مشاهده
                                            محصولات </a>
                                        <a href="{{route('admin.market.order.show-factor',[$order->id])}}"
                                           class="dropdown-item text-right"><i class="fa fa-images"></i> مشاهده
                                            فاکتور </a>
                                        <a href="{{route('admin.market.order.change-send-status',[$order->id])}}"
                                           class="dropdown-item text-right"><i class="fa fa-list-ul"></i> تغییر
                                            وضعیت ارسال </a>
                                        <a href="{{route('admin.market.order.change-order-status',[$order->id])}}"
                                           class="dropdown-item text-right"><i class="fa fa-edit"></i> تغییر وضعیت
                                            سفارش </a>
                                        <a href="{{route('admin.market.order.cancel-order',[$order->id])}}"
                                           class="dropdown-item text-right"><i class="fa fa-window-close"></i> باطل
                                            کردن سفارش </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$orders])
                </section>

            </section>
        </section>
    </section>

@endsection

@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')

    <!-- start vontent header -->
    <section class="content-header">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>تاریخچه سفارشات</span>
            </h2>
            <section class="content-header-link">
                <!--<a href="#">مشاهده همه</a>-->
            </section>
        </section>
    </section>
    <!-- end vontent header -->


    <section class="d-flex justify-content-center my-4">
        <a class="btn btn-info btn-sm mx-1" href="#">در انتظار پرداخت</a>
        <a class="btn btn-warning btn-sm mx-1" href="#">در حال پردازش</a>
        <a class="btn btn-success btn-sm mx-1" href="#">تحویل شده</a>
        <a class="btn btn-danger btn-sm mx-1" href="#">مرجوعی</a>
        <a class="btn btn-dark btn-sm mx-1" href="#">لغو شده</a>
    </section>


    <!-- start content header -->
    <section class="content-header mb-3">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title content-header-title-small">
                در انتظار پرداخت
            </h2>
            <section class="content-header-link">
                <!--<a href="#">مشاهده همه</a>-->
            </section>
        </section>
    </section>
    <!-- end content header -->


    <section class="order-wrapper">

        @forelse($orders as $order)

        <section class="order-item">
            <section class="d-flex justify-content-between">
                <section>
                    <section class="order-item-date"><i
                            class="fa fa-calendar-alt"></i>{{jalaliDate($order->created_at)}}</section>
                    <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش : {{$order->id}}</section>
                    <section class="order-item-status"><i class="fa fa-clock"></i> {{$order->order_status()}}</section>
                    <section class="order-item-products">
                        <a href="#"><img src="assets/images/products/20.jpg" alt=""></a>
                        <a href="#"><img src="assets/images/products/18.jpg" alt=""></a>
                        <a href="#"><img src="assets/images/products/17.jpg" alt=""></a>
                    </section>
                </section>
                <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
            </section>
        </section>
        @empty
            <section class="order-item">
                <section class="d-flex justify-content-between">
                    <p>سفارشی یافت نشد</p>
                </section>
            </section>
        @endforelse

    </section>

@endsection



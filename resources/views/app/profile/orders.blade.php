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
        <a class="btn btn-primary btn-sm mx-1" href="{{route('profile.orders')}}">همه سفارشات</a>
        <a class="btn btn-info btn-sm mx-1" href="{{route('profile.orders','type=0')}}">بررسی نشده</a>
        <a class="btn btn-warning btn-sm mx-1" href="{{route('profile.orders','type=1')}}">در انتظار تایید</a>
        <a class="btn btn-success btn-sm mx-1" href="{{route('profile.orders','type=2')}}">تایید شده</a>
        <a class="btn btn-outline-primary btn-sm mx-1" href="{{route('profile.orders','type=3')}}">تایید نشده</a>
        <a class="btn btn-danger btn-sm mx-1" href="{{route('profile.orders','type=4')}}">مرجوع شده</a>
        <a class="btn btn-dark btn-sm mx-1" href="{{route('profile.orders','type=5')}}">باطل شده</a>
    </section>


    <!-- start content header -->
    <section class="content-header mb-3">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title content-header-title-small">
                سفارشات
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
                    <section class="order-item-status"><i class="fa fa-clock"></i> وضعیت سفارش : {{$order->order_status()}}</section>
                    <section class="order-item-status"><i class="fa fa-cash-register"></i> نحوه پرداخت : {{$order->payment_type()}}</section>
                    <section class="order-item-status"><i class="fa fa-coins"></i> وضعیت پرداخت : {{$order->payment_status()}}</section>
                    <section class="order-item-status"><i class="fa fa-motorcycle"></i> شیوه ارسال : {{$order->delivery_type->name}}</section>
                    <section class="order-item-status"><i class="fa fa-box"></i> وضعیت ارسال : {{$order->delivery_status()}}</section>
                    <section class="order-item-products">
                        @foreach($order->items as $item)
                        <a href="{{route('market.product',$item->product->slug)}}"><img src="{{asset($item->product->image->indexArray->medium)}}" alt=""></a>
                        @endforeach
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



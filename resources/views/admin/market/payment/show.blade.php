@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> پرداخت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش پرداخت
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-green">
                        {{$payment->user->full_name}} - {{$payment->user->id}}
                    </section>
                    <section class="card-body">
                        <p class="card-text">نوع پرداخت : {{$payment->type()}}</p>
                        <p class="card-text">مبلغ پرداخت : {{number_format($payment->amount)}} تومان </p>
                        <p class="card-text">وضعیت پرداخت : {{$payment->status()}}</p>
                        <p class="card-text">شماره تراکنش
                            : {{$payment->paymentable->transaction_id ?? 'پرداخت در محل'}}</p>
                        <p class="card-text">تاریخ پرداخت : {{jalaliDate($payment->paymentable->pay_date)}}</p>
                        <p class="card-text">درگاه پرداخت : {{$payment->paymentable->gateway ?? 'پرداخت در محل'}}</p>
                        <p class="card-text">دریافت کننده وجه
                            : {{$payment->paymentable->cash_receiver ?? 'فروشگاه'}}</p>
                    </section>
                </section>

            </section>
        </section>
    </section>

@endsection

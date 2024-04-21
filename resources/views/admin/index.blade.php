@extends('admin.layouts.master')


@section('content')


    <section class="row">

        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.market.payment.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-success text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد پرداختی ها : {{$payments->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-money-bill"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.market.order.all')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد سفارشات : {{$orders->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-list"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.market.product.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-yellow text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد محصولات : {{$products->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.user.customer.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-warning text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد مشتریان : {{$users->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-users"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.ticket.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-pink text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد تیکت ها : {{$tickets->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.market.comment.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-custom-blue text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد نظرات : {{$comments->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-comment"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.content.post.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-danger text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد پست ها : {{$posts->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-paper-plane"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="{{route('admin.market.storage.index')}}" class="text-decoration-none d-block mb-4">
                <section class="card bg-primary text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h5>تعداد محصولات قابل فروش : {{$marketableProducts->count()}}</h5>
                                <h5>تعداد محصولات در سبد خرید : {{$frozenProducts->count()}}</h5>
                                <h5>تعداد محصولات فروخته شده : {{$soldProducts->count()}}</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-shopping-basket"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{jalaliDate(now())}}
                    </section>
                </section>
            </a>
        </section>

    </section>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پیشخوان بوتیکالا
                    </h5>
                    <p>
                        در این صفحه فروشگاه اینترنتی بوتیکالا مدیریت میشود
                    </p>
                </section>
                <section class="body-content">
                    <p>
                        فروشگاه بوتیکالا در سال 1403 فعالیت خود را در حوزه فروش پوشاک به صورت عمده و جزئی شروع و در حال حاضر در حال خدمت دهی به مشتریان میباشد.
                    </p>
                </section>
            </section>
        </section>
    </section>

@endsection

@extends('admin.layouts.master')

@section('head-tag')
    <title>تخفیف ها</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تخفیف عمومی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد تخفیف عمومی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد تخفیف عمومی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.common-discount.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.discount.common-discount.store')}}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">درصد تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="percentage"
                                           value="{{old('percentage')}}">
                                </div>
                                @error('percentage')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">سقف تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="discount_ceiling"
                                           value="{{old('discount_ceiling')}}">
                                </div>
                                @error('discount_ceiling')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عنوان مناسبت</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                           value="{{old('title')}}">
                                </div>
                                @error('title')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">حداقل مبلغ سفارش</label>
                                    <input type="text" class="form-control form-control-sm" name="minimal_order_amount"
                                           value="{{old('minimal_order_amount')}}">
                                </div>
                                @error('minimal_order_amount')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status')==0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status')==1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تاریخ شروع</label>
                                    <input type="text" class="form-control form-control-sm d-none" name="start_date"
                                           id="start_date">
                                    <input type="text" class="form-control form-control-sm" id="start_date_view"
                                           name="start_date_view">
                                </div>
                                @error('start_date')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تاریخ پایان</label>
                                    <input type="text" class="form-control form-control-sm d-none" name="end_date"
                                           id="end_date">
                                    <input type="text" class="form-control form-control-sm" id="end_date_view"
                                           name="end_date_view">
                                </div>
                                @error('end_date')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 my-1">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('scripts')

    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            });

            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
            });
        });
    </script>

@endsection

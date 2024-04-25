@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">سفارشات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش سفارش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش سفارش
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.order.all') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.order.update',$order) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">کد رهگیری</label>
                                    <input type="text" class="form-control form-control-sm" name="tracking_code"
                                           value="{{old('tracking_code',$order->tracking_code)}}">
                                </div>
                                @error('tracking_code')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12">
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

    <script>
        if ($('#type').find(':selected').val() == 1) {
            $('#users').removeAttr('disabled');
        }
        $('#type').change(function () {
            if ($('#type').find(':selected').val() == 1) {
                $('#users').removeAttr('disabled');
            } else {
                $('#users').attr('disabled', 'disabled');
            }
        })
    </script>

@endsection

@extends('admin.layouts.master')

@section('head-tag')
    <title>کوپن تخفیف</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کوپن تخفیف</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کوپن تخفیف
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.copan.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copan.update',[$copan->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">کد کوپن</label>
                                    <input type="text" class="form-control form-control-sm" name="code"
                                           value="{{old('code',$copan->code)}}">
                                </div>
                                @error('code')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع کوپن</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0" @if(old('type',$copan->type)==0) selected @endif>عمومی</option>
                                        <option value="1" @if(old('type',$copan->type)==1) selected @endif>خصوصی</option>
                                    </select>
                                </div>
                                @error('type')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">انتخاب کاربران</label>
                                    <select name="user_id" id="users" class="form-control form-control-sm" disabled>
                                        <option value="">کاربر را انتخاب کنید</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                                    @if(old('user_id',$copan->user_id)==$user->id) selected @endif>{{$user->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">میزان تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="amount"
                                           value="{{old('amount',$copan->amount)}}">
                                </div>
                                @error('amount')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع تخفیف</label>
                                    <select name="amount_type" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('amount_type',$copan->amount_type)==0) selected @endif>درصد</option>
                                        <option value="1" @if(old('amount_type',$copan->amount_type)==1) selected @endif>تومان</option>
                                    </select>
                                </div>
                                @error('amount_type')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">حداکثر تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="discount_ceiling"
                                           value="{{old('discount_ceiling',$copan->discount_ceiling)}}">
                                </div>
                                @error('discount_ceiling')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$copan->status)==0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status',$copan->status)==1) selected @endif>فعال</option>
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
                                           id="start_date" value="{{$copan->start_date}}">
                                    <input type="text" class="form-control form-control-sm" id="start_date_view"
                                           name="start_date_view" value="{{$copan->start_date}}">
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
                                           id="end_date" value="{{$copan->end_date}}">
                                    <input type="text" class="form-control form-control-sm" id="end_date_view"
                                           name="end_date_view" value="{{$copan->end_date}}">
                                </div>
                                @error('end_date')
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
        if ($('#type').find(':selected').val()==1) {
            $('#users').removeAttr('disabled');
        }
        $('#type').change(function () {
            if ($('#type').find(':selected').val()==1){
                $('#users').removeAttr('disabled');
            }else {
                $('#users').attr('disabled','disabled');
            }
        })
    </script>

@endsection

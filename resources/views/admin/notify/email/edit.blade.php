@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاع رسانی</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">ایمیل ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش ایمیل</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش ایمیل
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.notify.email.update',[$email->id])}}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عنوان ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" name="subject"
                                           value="{{old('subject',$email->subject)}}">
                                </div>
                                @error('subject')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$email->status)==0) selected @endif>غیر
                                            فعال
                                        </option>
                                        <option value="1" @if(old('status',$email->status)==1) selected @endif>فعال
                                        </option>
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
                                    <label for="">تاریخ انتشار</label>
                                    <input type="text" class="form-control form-control-sm d-none"
                                           name="published_at"
                                           id="published_at" value="{{$email->published_at}}">
                                    <input type="text" class="form-control form-control-sm" id="published_at_view"
                                           name="published_at_view" value="{{$email->published_at}}">
                                </div>
                                @error('published_at')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 my-1">
                                <div class="form-group">
                                    <label for="">متن ایمیل</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm"
                                              rows="6">{{old('body',$email->body)}}</textarea>
                                </div>
                                @error('body')
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

    @include('admin.layouts.ckeditor')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>

@endsection

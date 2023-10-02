@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">مشتریان</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مشتری</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش مشتری
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.customer.update',[$customer->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="first_name"
                                           value="{{old('first_name',$customer->first_name)}}">
                                </div>
                                @error('first_name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" class="form-control form-control-sm" name="last_name"
                                           value="{{old('last_name',$customer->last_name)}}">
                                </div>
                                @error('last_name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">رمز عبور</label>
                                    <input type="password" class="form-control form-control-sm" name="password">
                                </div>
                                @error('password')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تاییدیه رمز عبور</label>
                                    <input type="password" class="form-control form-control-sm"
                                           name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عکس پروفایل</label>
                                    <input type="file" class="form-control form-control-sm" name="profile_photo_path">
                                    <img src="{{asset($customer->profile_photo_path)}}" width="100" class="my-2">
                                </div>
                                @error('profile_photo_path')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت کاربر</label>
                                    <select name="activation" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('activation',$customer->activation)==0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('activation',$customer->activation)==1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('activation')
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

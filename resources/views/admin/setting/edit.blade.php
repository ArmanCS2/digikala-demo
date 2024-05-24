@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تنظیمات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update',[$setting->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عنوان سایت</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                           value="{{old('title',$setting->title)}}">
                                </div>
                                @error('title')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تلفن</label>
                                    <input type="text" class="form-control form-control-sm" name="tel"
                                           value="{{old('tel',$setting->tel)}}">
                                </div>
                                @error('tel')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" name="email"
                                           value="{{old('email',$setting->email)}}">
                                </div>
                                @error('email')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تلگرام</label>
                                    <input type="text" class="form-control form-control-sm" name="telegram"
                                           value="{{old('telegram',$setting->telegram)}}">
                                </div>
                                @error('telegram')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">واتساپ</label>
                                    <input type="text" class="form-control form-control-sm" name="whatsapp"
                                           value="{{old('whatsapp',$setting->whatsapp)}}">
                                </div>
                                @error('whatsapp')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وبسایت</label>
                                    <input type="text" class="form-control form-control-sm" name="my_site"
                                           value="{{old('my_site',$setting->my_site)}}">
                                </div>
                                @error('my_site')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">اینستاگرام</label>
                                    <input type="text" class="form-control form-control-sm" name="instagram"
                                           value="{{old('instagram',$setting->instagram)}}">
                                </div>
                                @error('instagram')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" class="form-control form-control-sm" name="address"
                                           value="{{old('address',$setting->address)}}">
                                </div>
                                @error('address')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">کلمات کلیدی</label>
                                    <input type="text" class="form-control form-control-sm" name="keywords"
                                           value="{{old('keywords',$setting->keywords)}}">
                                </div>
                                @error('keywords')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 1</label>
                                    <input type="text" class="form-control form-control-sm" name="link_1"
                                           value="{{old('link_1',$setting->link_1)}}">
                                </div>
                                @error('link_1')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 2</label>
                                    <input type="text" class="form-control form-control-sm" name="link_2"
                                           value="{{old('link_2',$setting->link_2)}}">
                                </div>
                                @error('link_2')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 3</label>
                                    <input type="text" class="form-control form-control-sm" name="link_3"
                                           value="{{old('link_2',$setting->link_3)}}">
                                </div>
                                @error('link_3')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 4</label>
                                    <input type="text" class="form-control form-control-sm" name="link_4"
                                           value="{{old('link_4',$setting->link_4)}}">
                                </div>
                                @error('link_4')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 5</label>
                                    <input type="text" class="form-control form-control-sm" name="link_5"
                                           value="{{old('link_5',$setting->link_5)}}">
                                </div>
                                @error('link_5')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 6</label>
                                    <input type="text" class="form-control form-control-sm" name="link_6"
                                           value="{{old('link_6',$setting->link_6)}}">
                                </div>
                                @error('link_6')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 7</label>
                                    <input type="text" class="form-control form-control-sm" name="link_7"
                                           value="{{old('link_7',$setting->link_7)}}">
                                </div>
                                @error('link_7')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 8</label>
                                    <input type="text" class="form-control form-control-sm" name="link_8"
                                           value="{{old('link_8',$setting->link_8)}}">
                                </div>
                                @error('link_8')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 9</label>
                                    <input type="text" class="form-control form-control-sm" name="link_9"
                                           value="{{old('link_9',$setting->link_9)}}">
                                </div>
                                @error('link_9')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک 10</label>
                                    <input type="text" class="form-control form-control-sm" name="link_10"
                                           value="{{old('link_10',$setting->link_10)}}">
                                </div>
                                @error('link_10')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="payment_status" id="" class="form-control form-control-sm">
                                        <option value="0"
                                                @if(old('status',$setting->payment_status)==0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1"
                                                @if(old('status',$setting->payment_status)==1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('payment_status')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 my-1">
                                <div class="form-group">
                                    <label for="">توضیحات سایت</label>
                                    <textarea name="description" id="description" class="form-control form-control-sm"
                                              rows="6">{{old('description',$setting->description)}}</textarea>
                                </div>
                                @error('description')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لوگو </label>
                                    <input type="file" class="form-control form-control-sm" name="logo">
                                </div>
                                @error('logo')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">آیکون</label>
                                    <input type="file" class="form-control form-control-sm" name="icon">
                                </div>
                                @error('icon')
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

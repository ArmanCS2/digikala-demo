@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاع رسانی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">ایمیل ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش فایل</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش فایل
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email-file.index',[$file->email->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="mx-4">
                    <form action="{{route('admin.notify.email-file.update',[$file->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="row">

                                <section class="col-12 my-1">
                                    <div class="form-group">
                                        <label for="">آپلود فایل </label>
                                        <input type="file" class="form-control form-control-sm" name="file">
                                    </div>
                                    @error('file')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>

                                <section class="col-12 my-1">
                                    <div class="form-group">
                                        <label for="">وضعیت</label>
                                        <select name="status" id="" class="form-control form-control-sm">
                                            <option value="0" @if(old('status',$file->status)==0) selected @endif>غیر فعال</option>
                                            <option value="1" @if(old('status',$file->status)==1) selected @endif>فعال</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>


                                <section class="col-12 my-1">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>

                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

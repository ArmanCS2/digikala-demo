@extends('admin.layouts.master')

@section('head-tag')
    <title>دسترسی ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">دسترسی ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسترسی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد دسترسی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.permission.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.permission.store')}}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام دسترسی</label>
                                    <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                                </div>
                                @error('name')
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

                            <section class="col-12 my-1">
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <input type="text" class="form-control form-control-sm" name="description" value="{{old('description')}}">
                                </div>
                                @error('description')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12  my-1">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

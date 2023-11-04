@extends('admin.layouts.master')

@section('head-tag')
    <title>بنر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بنر ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش بنر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش بنر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.banner.update',$banner->id)}}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عنوان بنر</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                           value="{{old('title',$banner->title)}}">
                                </div>
                                @error('title')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" class="form-control form-control-sm" name="url"
                                           value="{{old('url',$banner->url)}}">
                                </div>
                                @error('url')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">مکان</label>
                                    <select name="position" id="" class="form-control form-control-sm">
                                        <option value="">مکان را انتخاب کنید</option>
                                        @foreach($positions as $key => $position)
                                            <option value="{{$key}}" @if(old('position',$banner->position)===$key) selected @endif>{{$position}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('position')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$banner->status)==0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status',$banner->status)==1) selected @endif>فعال</option>
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
                                    <label for="">تصویر</label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                </div>
                                @error('image')
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

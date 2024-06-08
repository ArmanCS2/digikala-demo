@extends('admin.layouts.master')

@section('head-tag')
    <title>آلبوم ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">آلبوم ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش آلبوم</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش آلبوم
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.album.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.album.update',$album->id)}}" method="post" id="form"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                           value="{{old('name',$album->name)}}">
                                </div>
                                @error('name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک</label>
                                    <input type="text" class="form-control form-control-sm" name="link"
                                           value="{{old('link',$album->link)}}">
                                </div>
                                @error('link')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ترتیب</label>
                                    <input type="text" class="form-control form-control-sm" name="ordering"
                                           value="{{old('ordering',$album->ordering)}}">
                                </div>
                                @error('ordering')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نوع</label>
                                    <select name="type" id="" class="form-control form-control-sm">

                                        <option value="0"
                                                @if(old('type',$album->type)==0) selected @endif>تصویر
                                        </option>
                                        <option value="1"
                                                @if(old('type',$album->type)==1) selected @endif>ویدیو
                                        </option>

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
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$album->status)==0) selected @endif>غیر
                                            فعال
                                        </option>
                                        <option value="1" @if(old('status',$album->status)==1) selected @endif>فعال
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
                                    <label for="">تصویر</label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                </div>
                                @error('image')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویدیو</label>
                                    <input type="file" class="form-control form-control-sm" name="video">
                                </div>
                                @error('video')
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


    <script>
        $(function () {
            $('#btn-copy').on('click', function () {
                var ele = $(this).parent().prev().clone(true);
                $(this).before(ele);
            })
        })
    </script>

@endsection

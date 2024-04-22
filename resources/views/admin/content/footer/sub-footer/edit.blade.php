@extends('admin.layouts.master')

@section('head-tag')
    <title>منو ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">زیر فوتر ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش زیر فوتر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش زیر فوتر
                    </h5>
                    <h6><a href="{{ route('admin.content.footer.index') }}">{{$subFooter->footer->title}}</a></h6>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.sub-footer.index',$subFooter->footer) }}"
                       class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.sub-footer.update',$subFooter)}}" method="post" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام زیر فوتر</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                           value="{{old('title',$subFooter->title)}}">
                                </div>
                                @error('title')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ترتیب زیر فوتر</label>
                                    <input type="text" class="form-control form-control-sm" name="order"
                                           value="{{old('order',$subFooter->order)}}">
                                </div>
                                @error('order')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">لینک</label>
                                    <input type="text" class="form-control form-control-sm" name="link"
                                           value="{{old('link',$subFooter->link)}}">
                                </div>
                                @error('link')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$subFooter->status)==0) selected @endif>غیر
                                            فعال
                                        </option>
                                        <option value="1" @if(old('status',$subFooter->status)==1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
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

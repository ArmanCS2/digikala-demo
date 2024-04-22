@extends('admin.layouts.master')

@section('head-tag')
    <title>منو ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">منو ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش منو
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.menu.update',[$menu->id])}}" method="post" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام منو</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                           value="{{old('name',$menu->name)}}">
                                </div>
                                @error('name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ترتیب منو</label>
                                    <input type="text" class="form-control form-control-sm" name="order"
                                           value="{{old('order',$menu->order)}}">
                                </div>
                                @error('order')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($menus as $sub_menu)
                                            @if($menu->id !=$sub_menu->id)
                                                <option value="{{$sub_menu->id}}"
                                                        @if(old('parent_id',$menu->parent_id)==$sub_menu->id) selected @endif>{{$sub_menu->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">آدرس url</label>
                                    <input type="text" class="form-control form-control-sm" name="url"
                                           value="{{old('url',$menu->url)}}">
                                </div>
                                @error('url')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$menu->status)==0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if(old('status',$menu->status)==1) selected @endif>فعال
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

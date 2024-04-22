@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.category.store')}}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام دسته</label>
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
                                    <label for="">ترتیب</label>
                                    <input type="text" class="form-control form-control-sm" name="order"
                                           value="{{old('order')}}">
                                </div>
                                @error('order')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags" value="{{old('tags')}}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">دسته والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(old('parent_id')==$category->id) selected @endif>{{$category->name}}</option>
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

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نمایش در منو</label>
                                    <select name="show_in_menu" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('show_in_menu')==0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('show_in_menu')==1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('show_in_menu')
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
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <textarea name="description" id="description" class="form-control form-control-sm"
                                              rows="6">{{old('description')}}</textarea>
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

@section('scripts')

    @include('admin.layouts.ckeditor')

    <script>
        $(document).ready(function (){
            var tags_input=$('#tags');
            var select_tags=$('#select_tags');
            var default_tags=tags_input.val();
            var default_data = null;

            if(tags_input.val() !== null  && tags_input.val().length > 0 ) {
                default_data=default_tags.split(',');
            }
            select_tags.select2({
                placeholder:'لطفا تگ های خود را وارد کنید',
                tags:true,
                data:default_data
            });

            select_tags.children('option').attr('selected',true).trigger('change');

            $('#form').submit(function ( event ){
                if(select_tags.val() !== null  && select_tags.val().length > 0 ){
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })

        })
    </script>

@endsection

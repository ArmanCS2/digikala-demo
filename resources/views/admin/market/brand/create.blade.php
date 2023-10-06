@extends('admin.layouts.master')

@section('head-tag')
    <title>برند ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">برند ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد برند جدید</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد برند جدید
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.brand.store')}}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام فارسی برند</label>
                                    <input type="text" class="form-control form-control-sm" name="persian_name" value="{{old('persian_name')}}">
                                </div>
                                @error('persian_name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام اصلی برند</label>
                                    <input type="text" class="form-control form-control-sm" name="original_name" value="{{old('original_name')}}">
                                </div>
                                @error('original_name')
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
                                    <label for="">لوگو</label>
                                    <input type="file" class="form-control form-control-sm" name="logo">
                                </div>
                                @error('logo')
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

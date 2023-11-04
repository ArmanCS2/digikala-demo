@extends('admin.layouts.master')

@section('head-tag')
    <title>رنگ کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش رنگ</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش رنگ
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.color.index',[$color->product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="mx-4">
                    <form action="{{route('admin.market.product.color.update',[$color->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <section class="row">



                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">نام رنگ</label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                               value="{{old('name',$color->name)}}">
                                    </div>
                                    @error('name')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>

                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">رنگ</label>
                                        <input type="color" class="form-control form-control-sm" name="color"
                                               value="{{old('color',$color->color)}}">
                                    </div>
                                    @error('color')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>

                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">میزان افزایش قیمت</label>
                                        <input type="text" class="form-control form-control-sm" name="price_increase"
                                               value="{{old('price_increase',$color->price_increase)}}">
                                    </div>
                                    @error('price_increase')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>


                                <section class="col-12 my-1">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

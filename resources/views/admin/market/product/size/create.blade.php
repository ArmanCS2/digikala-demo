@extends('admin.layouts.master')

@section('head-tag')
    <title>سایز کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد سایز جدید</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد سایز جدید
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.size.index',[$product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="mx-4">
                    <form action="{{route('admin.market.product.size.store',[$product->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <section class="row">


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">سایز</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                           value="{{old('name')}}">
                                </div>
                                @error('name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عرض</label>
                                    <input type="text" class="form-control form-control-sm" name="width"
                                           value="{{old('width')}}">
                                </div>
                                @error('width')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">قد</label>
                                    <input type="text" class="form-control form-control-sm" name="height"
                                           value="{{old('height')}}">
                                </div>
                                @error('height')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">میزان افزایش قیمت</label>
                                    <input type="text" class="form-control form-control-sm" name="price_increase"
                                           value="{{old('price_increase')}}">
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

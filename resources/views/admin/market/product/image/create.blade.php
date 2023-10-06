@extends('admin.layouts.master')

@section('head-tag')
    <title>تصاویر کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن تصویر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اضافه کردن تصویر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.image.index',[$product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="mx-4">
                    <form action="{{route('admin.market.product.image.store',[$product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                            <section class="row">



                                <section class="col-12 my-1">
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

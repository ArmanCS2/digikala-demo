@extends('admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">افزایش موجودی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h6>
                        افزایش موجودی برای:
                    </h6>
                    <h5>
                        {{$product->name}}
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.storage.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.storage.store',[$product->id]) }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام تحویل گیرنده</label>
                                    <input type="text" name="receiver" class="form-control form-control-sm" value="{{old('receiver')}}">
                                </div>
                                @error('receiver')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام تحویل دهنده</label>
                                    <input type="text" name="deliverer" class="form-control form-control-sm" value="{{old('deliverer')}}">
                                </div>
                                @error('deliverer')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">میزان افزایش موجودی</label>
                                    <input type="text" name="product_count" class="form-control form-control-sm" value="{{old('product_count')}}">
                                </div>
                                @error('product_count')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-1">
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <textarea row="4" name="description" class="form-control form-control-sm">{{old('description')}}</textarea >
                                </div>
                                @error('description')
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

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
            <li class="breadcrumb-item font-size-12 active" aria-current="page">اصلاح موجودی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h6>
                        اصلاح موجودی برای:
                    </h6>
                    <h5>
                        {{$product->name}}
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.storage.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.storage.update',[$product->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تعداد قابل فروش</label>
                                    <input type="text" name="marketable_number" class="form-control form-control-sm" value="{{old('marketable_number',$product->marketable_number)}}">
                                </div>
                                @error('marketable_number')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تعداد رزرو شده</label>
                                    <input type="text" name="frozen_number" class="form-control form-control-sm" value="{{old('frozen_number',$product->frozen_number)}}">
                                </div>
                                @error('frozen_number')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تعداد فروخته شده</label>
                                    <input type="text" name="sold_number" class="form-control form-control-sm" value="{{old('sold_number',$product->sold_number)}}">
                                </div>
                                @error('sold_number')
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

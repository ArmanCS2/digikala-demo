@extends('admin.layouts.master')

@section('head-tag')
    <title>گارانتی کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش گارانتی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش گارانتی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.guarantee.index',[$guarantee->product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="mx-4">
                    <form action="{{route('admin.market.product.guarantee.update',[$guarantee->product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <section class="row">



                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">نام گارانتی</label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                               value="{{old('name',$guarantee->name)}}">
                                    </div>
                                    @error('name')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>

                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">میزان افزایش قیمت</label>
                                        <input type="text" class="form-control form-control-sm" name="price_increase"
                                               value="{{old('price_increase',$guarantee->price_increase)}}">
                                    </div>
                                    @error('price_increase')
                                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                    @enderror
                                </section>

                                <section class="col-12 col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">وضعیت</label>
                                        <select name="status" id="" class="form-control form-control-sm">
                                            <option value="0" @if(old('status',$guarantee->status)==0) selected @endif>غیر فعال</option>
                                            <option value="1" @if(old('status',$guarantee->status)==1) selected @endif>فعال</option>
                                        </select>
                                    </div>
                                    @error('status')
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

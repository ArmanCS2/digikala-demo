@extends('admin.layouts.master')

@section('head-tag')
    <title>فرم کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مقدار فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        {{$attribute->category->name}}
                    </h5>
                    <h6>
                        {{$attribute->name}}
                    </h6>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.attribute.value.index',[$value->attribute->id]) }}"
                       class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.category.attribute.value.update',[$value->id])}}"
                          method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">انتخاب کالا</label>
                                    <select name="product_id" id="" class="form-control form-control-sm">
                                        <option value="">کالا را انتخاب کنید</option>
                                        @foreach($value->attribute->category->products ?? [] as $product)
                                            <option value="{{$product->id}}"
                                                    @if(old('product_id',$value->product->id)==$product->id) selected @endif>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">مقدار</label>
                                    <input type="text" class="form-control form-control-sm" name="value"
                                           value="{{old('value',json_decode($value->value)->value)}}">
                                </div>
                                @error('value')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">میزان افزایش قیمت</label>
                                    <input type="text" class="form-control form-control-sm" name="price_increase"
                                           value="{{old('price_increase',json_decode($value->value)->price_increase)}}">
                                </div>
                                @error('price_increase')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نوع نمایش</label>
                                    <select name="type" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('type',$value->type)==0) selected @endif>ساده</option>
                                        <option value="1" @if(old('type',$value->type)==1) selected @endif>انتخابی
                                        </option>
                                    </select>
                                </div>
                                @error('type')
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

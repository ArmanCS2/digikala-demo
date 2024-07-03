@extends('admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> انبار</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th>اندازه ها</th>
                            <th>قابل فروش</th>
                            <th>رزرو شده</th>
                            <th>فروخته شده</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$product->name}}</td>
                                <td><img src="{{asset($product->image['indexArray'][$product->image['currentImage']])}}"
                                         width="100px"></td>
                                <td>
                                    @foreach($product->sizes as $size)
                                        <div>
                                            {{$size->name}}
                                            -
                                            {{$size->marketable_number}}
                                        </div>
                                    @endforeach
                                </td>
                                <td>{{$product->marketable_number}}</td>
                                <td>{{$product->frozen_number}}</td>
                                <td>{{$product->sold_number}}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.storage.add-product',[$product->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> افزایش موجودی</a>
                                    <a href="{{route('admin.market.storage.edit',[$product->id])}}"
                                       class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> اصلاح موجودی</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$products])
                </section>

            </section>
        </section>
    </section>

@endsection

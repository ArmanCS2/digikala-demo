@extends('admin.layouts.master')

@section('head-tag')
    <title>سایز کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">سایز کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        {{$product->name}}
                    </h5>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.size.create',[$product->id]) }}"
                       class="btn btn-info btn-sm">ایجاد سایز جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>سایز</th>
                            <th>عرض</th>
                            <th>قد</th>
                            <th>میزان افزایش قیمت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sizes as $key => $size)
                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$size->name}}</td>
                                <td>{{$size->width}}</td>
                                <td>{{$size->height}}</td>
                                <td>{{number_format($size->price_increase)}} تومان</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.product.size.edit',[$size->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{route('admin.market.product.size.destroy',[$size->id])}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                class="fa fa-trash-alt"></i> حذف
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$sizes])
                </section>

            </section>
        </section>
    </section>

@endsection

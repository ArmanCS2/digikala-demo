@extends('admin.layouts.master')

@section('head-tag')
    <title>رنگ کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">رنگ کالا</li>
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
                    <a href="{{ route('admin.market.product.color.create',[$product->id]) }}"
                       class="btn btn-info btn-sm">ایجاد رنگ جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام رنگ</th>
                            <th>میزان افزایش قیمت</th>
                            <th>رنگ</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->colors as $key => $color)
                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$color->name}}</td>
                                <td>{{number_format($color->price_increase)}} تومان</td>
                                <td><a class="btn" style="background-color: {{$color->color}}"></a></td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.product.color.edit',[$color->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline"
                                          action="{{route('admin.market.product.color.destroy',[$color->id])}}"
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
                </section>

            </section>
        </section>
    </section>

@endsection

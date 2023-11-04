@extends('admin.layouts.master')

@section('head-tag')
    <title>فرم کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقادیر فرم کالا</li>
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
                    <a href="{{ route('admin.market.category.attribute.value.create',[$attribute->id]) }}" class="btn btn-info btn-sm">ایجاد مقدار فرم کالا</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>مقدار</th>
                            <th>میزان افزایش قیمت</th>
                            <th>نام کالا</th>
                            <th>نوع نمایش</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attribute->values as $key => $value)
                        <tr>
                            <th>{{$key + 1}}</th>
                            <td>{{json_decode($value->value)->value}}</td>
                            <td>{{number_format(json_decode($value->value)->price_increase)}} تومان </td>
                            <td>{{$value->product->name}}</td>
                            <td>{{$value->type==0 ? 'ساده' : 'انتخابی'}}</td>
                            <td class="width-22-rem text-left">
                                <a href="{{route('admin.market.category.attribute.value.edit',[$value->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.category.attribute.value.destroy',[$value->id])}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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

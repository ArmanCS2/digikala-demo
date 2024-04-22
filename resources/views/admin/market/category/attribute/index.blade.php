@extends('admin.layouts.master')

@section('head-tag')
    <title>فرم کالا</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فرم کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.attribute.create') }}" class="btn btn-info btn-sm">ایجاد
                        فرم جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام فرم کالا</th>
                            <th>واحد اندازه گیری</th>
                            <th>دسته والد</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attributes as $key => $attribute)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$attribute->name}}</td>
                                <td>{{$attribute->unit}}</td>
                                <td>{{$attribute->category->name ?? '-'}}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.category.attribute.value.index',[$attribute->id])}}"
                                       class="btn btn-info btn-sm"><i class="fa fa-list-ul"></i> مقادیر</a>
                                    <a href="{{route('admin.market.category.attribute.edit',[$attribute->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form action="{{route('admin.market.category.attribute.destroy',[$attribute->id])}}"
                                          method="post" class="d-inline">
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
                    @include('admin.layouts.pagination',['data'=>$attributes])
                </section>

            </section>
        </section>
    </section>

@endsection

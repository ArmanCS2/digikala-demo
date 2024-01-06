@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        تنظیمات
                    </h5>
                </section>


                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان سایت</th>
                            <th>توضیحات سایت</th>
                            <th>کلمات کلیدی</th>
                            <th>لوگو سایت</th>
                            <th>آیکون سایت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>{{$setting->title}}</td>
                            <td>{{$setting->description}}</td>
                            <td>{{$setting->keywords}}</td>
                            <td><img src="{{asset($setting->logo)}}" class="max-height-4rem"></td>
                            <td><img src="{{asset($setting->icon)}}" class="max-height-4rem"></td>
                            <td class="width-16-rem text-left">
                                <a href="{{route('admin.setting.edit',[$setting->id])}}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-edit"></i> ویرایش</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection

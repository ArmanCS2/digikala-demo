@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>
                @include('alerts.alert-section.success')
                @include('alerts.alert-section.error')
                @include('alerts.alert-section.info')
                @include('alerts.alert-section.warning')

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته
                        بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>دسته والد</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>اسلاگ</th>
                            <th>تگ ها</th>
                            <th>نمایش در منو</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productCategories as $key => $productCategory)
                            <tr>
                                <th>{{{$key+1}}}</th>
                                <td>{{$productCategory->name}}</td>
                                <th>{{$productCategory->parent->name ?? 'اصلی'}}</th>
                                <td>{{$productCategory->description}}</td>
                                <td><img src="{{asset($productCategory->image['indexArray'][$productCategory->image['currentImage']])}}" width="50px" height="50px"></td>
                                <td>{{$productCategory->slug}}</td>
                                <td>{{$productCategory->tags}}</td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_visibility_{{$productCategory->id}}"
                                               onchange="changeVisibility({{$productCategory->id}})"
                                               data-url="{{route('admin.market.category.ajax.change-visibility',[$productCategory->id])}}"
                                               @if($productCategory->status==1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_status_{{$productCategory->id}}"
                                               onchange="changeStatus({{$productCategory->id}})"
                                               data-url="{{route('admin.market.category.ajax.change-status',[$productCategory->id])}}"
                                               @if($productCategory->status==1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.category.edit',[$productCategory->id]) }}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form action="{{ route('admin.market.category.destroy',[$productCategory->id]) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
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

@section('scripts')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $('#change_status_' + id);
            var url = element.attr('data-url');
            var elementValue=!element.prop('checked');

            $.ajax({
                url : url,
                type:"GET",
                success:function (response){
                    if (response.status){
                        if (response.checked){
                            element.prop('checked',true);
                            successToast('دسته بندی با موفقیت فعال شد');
                        }else {
                            element.prop('checked',false);
                            successToast('دسته بندی با موفقیت غیر فعال شد');
                        }
                    }else {
                        element.prop('checked',elementValue);
                        errorToast('خطا در تغییر وضعیت');
                    }
                },
                error:function () {
                    element.prop('checked',elementValue);
                    errorToast('خطا در برقراری ارتباط');
                }
            });

            function successToast(message){
                var successToastTag='<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                '<strong class="ml-auto">'+message+'</strong>\n' +
                '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n'+
                '</button>\n' +
                '</section>\n'+
                '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(3000).queue(function () {
                    $(this).remove();
                });
            }

            function errorToast(message){
                var errorToastTag='<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">'+message+'</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n' +
                    '</section>\n'+
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(4000).queue(function () {
                    $(this).remove();
                });
            }
        }

        function changeVisibility(id) {
            var element = $('#change_visibility_' + id);
            var url = element.attr('data-url');
            var elementValue=!element.prop('checked');

            $.ajax({
                url : url,
                type:"GET",
                success:function (response){
                    if (response.status){
                        if (response.checked){
                            element.prop('checked',true);
                            successToast('نمایش در منو با موفقیت فعال شد');
                        }else {
                            element.prop('checked',false);
                            successToast('نمایش در منو با موفقیت غیر فعال شد');
                        }
                    }else {
                        element.prop('checked',elementValue);
                        errorToast('خطا در تغییر وضعیت');
                    }
                },
                error:function () {
                    element.prop('checked',elementValue);
                    errorToast('خطا در برقراری ارتباط');
                }
            });

            function successToast(message){
                var successToastTag='<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">'+message+'</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n' +
                    '</section>\n'+
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(3000).queue(function () {
                    $(this).remove();
                });
            }

            function errorToast(message){
                var errorToastTag='<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">'+message+'</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n' +
                    '</section>\n'+
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(4000).queue(function () {
                    $(this).remove();
                });
            }
        }
    </script>
@endsection

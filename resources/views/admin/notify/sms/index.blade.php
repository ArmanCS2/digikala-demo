@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاع رسانی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">پیامک ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پیامک ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-info btn-sm">ایجاد پیامک جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پیامک</th>
                            <th>متن پیامک</th>
                            <th>تاریخ ارسال</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($smses as $key => $sms)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$sms->title}}</td>
                            <td>{{$sms->body}}</td>
                            <td>{{jalaliDate($sms->published_at,'H:i:s Y-m-d')}}</td>
                            <td>
                                <label>
                                    <input type="checkbox" id="change_status_{{$sms->id}}"
                                           onchange="changeStatus({{$sms->id}})"
                                           data-url="{{route('admin.notify.sms.ajax.change-status',[$sms->id])}}"
                                           @if($sms->status==1) checked @endif>
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{route('admin.notify.sms.edit',[$sms->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{route('admin.notify.sms.destroy',[$sms->id])}}" method="post">
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
                            successToast('پیامک با موفقیت فعال شد');
                        }else {
                            element.prop('checked',false);
                            successToast('پیامک با موفقیت غیر فعال شد');
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

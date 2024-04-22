@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاع رسانی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ایمیل ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایمیل ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email.create') }}" class="btn btn-info btn-sm">ایجاد ایمیل جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان ایمیل</th>
                            <th>متن ایمیل</th>
                            <th>تاریخ ارسال</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emails as $key => $email)
                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$email->subject}}</td>
                                <td>{{$email->body}}</td>
                                <td>{{jalaliDate($email->published_at,'H:i:s Y-m-d')}}</td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_status_{{$email->id}}"
                                               onchange="changeStatus({{$email->id}})"
                                               data-url="{{route('admin.notify.email.ajax.change-status',[$email->id])}}"
                                               @if($email->status==1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.notify.email-file.index',[$email->id])}}"
                                       class="btn btn-warning btn-sm"><i class="fa fa-file"></i> فایل های ضمیمه شده</a>
                                    <a href="{{route('admin.notify.email.edit',[$email->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{route('admin.notify.email.destroy',[$email->id])}}"
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
                    @include('admin.layouts.pagination',['data'=>$emails])
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
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('ایمیل با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToast('ایمیل با موفقیت غیر فعال شد');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('خطا در تغییر وضعیت');
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('خطا در برقراری ارتباط');
                }
            });

            function successToast(message) {
                var successToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="4000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast-wrapper').removeClass('d-none');
                $('.toast').toast('show').delay(4000).queue(function () {
                    $('.toast-wrapper').addClass('d-none');
                    $(this).remove();
                });
            }
        }
    </script>
@endsection

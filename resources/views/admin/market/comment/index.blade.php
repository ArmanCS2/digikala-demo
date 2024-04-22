@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
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
                            <th>نام کاربر</th>
                            <th>نام کالا</th>
                            <th>متن نظر</th>
                            <th>پاسخ به</th>
                            <th>وضعیت تایید</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $key => $comment)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$comment->user->full_name}}</td>
                                <td>{{$comment->commentable->name}}</td>
                                <td>{{$comment->body}}</td>
                                <td>{{ !empty($comment->parent->body) ? \Illuminate\Support\Str::limit($comment->parent->body,10) : '-'}}</td>
                                <td>{{$comment->approved == 0 ? 'تایید نشده' : 'تایید شده'}}</td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_status_{{$comment->id}}"
                                               onchange="changeStatus({{$comment->id}})"
                                               data-url="{{route('admin.market.comment.ajax.change-status',[$comment->id])}}"
                                               @if($comment->status==1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.comment.show',[$comment->id])}}"
                                       class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>
                                    @if($comment->approved==0)
                                        <a href="{{route('admin.market.comment.approved',[$comment->id])}}"
                                           class="btn btn-success btn-sm"><i class="fa fa-check"></i> تایید</a>
                                    @else
                                        <a href="{{route('admin.market.comment.approved',[$comment->id])}}"
                                           class="btn btn-warning btn-sm"><i class="fa fa-clock"></i> عدم تایید</a>
                                    @endif
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i>
                                        حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$comments])
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
                            successToast('نظر با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToast('نظر با موفقیت غیر فعال شد');
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

@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کاربران ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین
                        جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربری</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نقش ها</th>
                            <th>دسترسی ها</th>
                            <th>وضعیت کاربر</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $key => $admin)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$admin->full_name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->mobile}}</td>
                                <td>
                                    @forelse($admin->roles as $role)
                                        <div>
                                            {{$role->name}}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            نقشی یافت نشد
                                        </div>
                                    @endforelse
                                </td>
                                <td>
                                    @forelse($admin->permissions as $permission)
                                        <div>
                                            {{$permission->name}}
                                        </div>
                                    @empty
                                        <div class="text-danger">
                                            دسترسی یافت نشد
                                        </div>
                                    @endforelse
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_activation_{{$admin->id}}"
                                               onchange="changeActivation({{$admin->id}})"
                                               data-url="{{route('admin.user.admin-user.ajax.change-activation',[$admin->id])}}"
                                               @if($admin->activation==1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" id="change_status_{{$admin->id}}"
                                               onchange="changeStatus({{$admin->id}})"
                                               data-url="{{route('admin.user.admin-user.ajax.change-status',[$admin->id])}}"
                                               @if($admin->status==1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-44-rem text-left">
                                    <a href="{{route('admin.user.admin-user.roles',[$admin->id])}}"
                                       class="btn btn-info btn-sm"><i class="fa fa-list-ul"></i> نقش ها</a>
                                    <a href="{{route('admin.user.admin-user.permissions',[$admin->id])}}"
                                       class="btn btn-warning btn-sm"><i class="fa fa-list-ul"></i> دسترسی ها</a>
                                    <a href="{{route('admin.user.admin-user.edit',[$admin->id])}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form action="{{route('admin.user.admin-user.destroy',[$admin->id])}}" method="post"
                                          class="d-inline">
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
                    @include('admin.layouts.pagination',['data'=>$admins])
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
                            successToast('وضعیت با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToast('وضعیت با موفقیت غیر فعال شد');
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
                var successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(3000).queue(function () {
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(4000).queue(function () {
                    $(this).remove();
                });
            }
        }

        function changeActivation(id) {
            var element = $('#change_activation_' + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('وضعیت کاربر با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            successToast('وضعیت کاربر با موفقیت غیر فعال شد');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('خطا در تغییر وضعیت کاربر');
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

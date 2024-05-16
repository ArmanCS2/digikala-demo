@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>پروفایل</title>
@endsection

@section('content')

    <!-- start vontent header -->
    <section class="content-header mb-4">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>اطلاعات حساب</span>
            </h2>
            <section class="content-header-link">
                <!--<a href="#">مشاهده همه</a>-->
            </section>
        </section>
    </section>
    <!-- end vontent header -->

    <section class="d-flex justify-content-end my-4">
        <button class="btn btn-link btn-sm text-info text-decoration-none mx-1" type="button" data-bs-toggle="modal"
                data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش
            حساب
        </button>
    </section>


    <section class="row">
        <section class="col-6 border-bottom mb-2 py-2">
            <section class="field-title">نام</section>
            <section class="field-value overflow-auto">{{$user->first_name ?? '-'}}</section>
        </section>

        <section class="col-6 border-bottom my-2 py-2">
            <section class="field-title">نام خانوادگی</section>
            <section class="field-value overflow-auto">{{$user->last_name ?? '-'}}</section>
        </section>

        <section class="col-6 border-bottom my-2 py-2">
            <section class="field-title">شماره تلفن همراه</section>
            <section class="field-value overflow-auto">{{$user->mobile ?? '-'}}</section>
        </section>

        <section class="col-6 border-bottom my-2 py-2">
            <section class="field-title">ایمیل</section>
            <section class="field-value overflow-auto">{{$user->email ?? '-'}}</section>
        </section>

        <section class="col-6 my-2 py-2">
            <section class="field-title">کد ملی</section>
            <section class="field-value overflow-auto">{{$user->national_code ?? '-'}}</section>
        </section>

        <section class="col-6 my-2 py-2">
            <section class="field-title">وضعیت</section>
            <section class="field-value overflow-auto">{{$user->is_active == 1 ? 'فعال' : 'غیر فعال'}}</section>
        </section>

        <section class="address-add-wrapper">
            <!-- start add address Modal -->
            <section class="modal fade" id="edit-profile" tabindex="-1"
                     aria-labelledby="edit-profile-label" aria-hidden="true">
                <section class="modal-dialog">
                    <section class="modal-content">
                        <section class="modal-header">
                            <h5 class="modal-title" id="edit-profile-label"><i
                                    class="fa fa-plus"></i> ویرایش حساب</h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </section>
                        <section class="modal-body">
                            <form id="edit-profile-form" class="row"
                                  method="post"
                                  action="{{route('profile.update')}}">
                                @csrf
                                @method('put')

                                <section class="col-6 mb-2">
                                    <label for="first_name" class="form-label mb-1">نام</label>
                                    <input name="first_name" type="text"
                                           class="form-control form-control-sm"
                                           id="first_name" placeholder="{{$user->first_name ?? 'نام'}}"
                                           value="">
                                    @error('first_name')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="last_name" class="form-label mb-1">نام خانوادگی</label>
                                    <input name="last_name" type="text"
                                           class="form-control form-control-sm"
                                           id="last_name" placeholder="{{$user->last_name ?? 'نام خانوادگی'}}"
                                           value="">
                                    @error('last_name')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="email"
                                           class="form-label mb-1">ایمیل</label>
                                    <input name="email" type="text"
                                           class="form-control form-control-sm"
                                           id="email" placeholder="{{$user->email ?? 'ایمیل'}}"
                                           value="">
                                    @error('email')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror
                                </section>

                                <section class="col-6 mb-2">
                                    <label for="national_code"
                                           class="form-label mb-1">کد ملی</label>
                                    <input name="national_code" type="text"
                                           class="form-control form-control-sm"
                                           id="national_code" placeholder="{{$user->national_code ?? 'کد ملی'}}"
                                           value="">
                                    @error('national_code')
                                    <span class="text-danger">
                                                                    <strong>{{$message}}</strong>
                                                                </span>
                                    @enderror
                                </section>

                            </form>
                        </section>
                        <section class="modal-footer py-1">
                            <button
                                onclick="document.getElementById('edit-profile-form').submit();"
                                class="btn btn-sm btn-primary">ویرایش حساب
                            </button>
                            <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal">بستن
                            </button>
                        </section>
                    </section>
                </section>
            </section>
            <!-- end add address Modal -->
        </section>

    </section>


@endsection



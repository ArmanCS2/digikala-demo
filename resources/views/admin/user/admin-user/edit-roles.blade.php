@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش نقش ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نام ادمین : {{$admin->full_name}}
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.user.admin-user.roles.update',[$admin->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12">
                                <section class="row ">
                                    @php
                                        $rolesArray=$admin->roles->pluck('id')->toArray();
                                    @endphp
                                    @foreach($roles as $key => $role)
                                        <section class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                       value="{{$role->id}}" name="roles[]"
                                                       id="{{$role->id}}"
                                                       @if(in_array($role->id,$rolesArray)) checked @endif>
                                                <label for="{{$role->id}}"
                                                       class="form-check-label mr-3 mt-1">{{$role->name}}</label>
                                            </div>
                                            <div class="my-1">
                                                @error('roles.' . $key)
                                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                                @enderror
                                            </div>
                                        </section>
                                    @endforeach
                                </section>
                            </section>
                            <section class="col-12 col-md-2 mt-4">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

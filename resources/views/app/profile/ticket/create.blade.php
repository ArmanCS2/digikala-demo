@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>تیکت ها</title>
@endsection


@section('content')


    <!-- start vontent header -->
    <section class="content-header m-1">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>ایجاد تیکت</span>
            </h2>
            <section class="content-header-link m-2">
                <a href="{{route('profile.ticket.index')}}" class="btn btn-danger text-white">بازگشت</a>
            </section>
        </section>
    </section>
    <!-- end vontent header -->


    <section class="my-3">
        <form action="{{route('profile.ticket.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <section class="row">
                <section class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="" class="">عنوان</label>
                        ‍<input class="form-control form-control-sm" rows="4" name="subject"
                                value="{{ old('subject') }}"/>
                    </div>
                    @error('subject')
                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                    @enderror
                </section>
                <section class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">انتخاب دسته</label>
                        <select name="category_id" id="" class="form-control form-control-sm">
                            <option value="">دسته را انتخاب کنید</option>
                            @foreach ($ticketCategories as $ticketCategory)
                                <option value="{{ $ticketCategory->id }}"
                                        @if(old('category_id')==$ticketCategory->id) selected @endif>{{
                                                    $ticketCategory->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    @error('category_id')
                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                    @enderror
                </section>

                <section class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">انتخاب اولویت</label>
                        <select name="priority_id" id="" class="form-control form-control-sm">
                            <option value="">اولویت را انتخاب کنید</option>
                            @foreach ($ticketPriorities as $ticketPriority)
                                <option value="{{ $ticketPriority->id }}"
                                        @if(old('priority_id')==$ticketPriority->id) selected @endif>{{
                                                    $ticketPriority->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    @error('priority_id')
                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                    @enderror
                </section>


                <section class="col-12">
                    <div class="form-group">
                        <label for="" class="my-2">متن</label>
                        ‍<textarea class="form-control form-control-sm" rows="4"
                                   name="description">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                    @enderror
                </section>

                <section class="col-12 my-2">
                    <div class="form-group">
                        <label for="file">فایل</label>
                        <input type="file" class="form-control form-control-sm" name="file"
                               id="file">
                    </div>
                    @error('file')
                    <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                    @enderror
                </section>


                <section class="col-12 my-3">
                    <button class="btn btn-primary btn-sm">ثبت</button>
                </section>
            </section>
        </form>
    </section>
@endsection




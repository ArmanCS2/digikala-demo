@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{$comment->user->full_name}} - {{$comment->user->id}}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">عنوان پست : {{$comment->commentable->title}} کد پست : {{$comment->commentable->id}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                    </section>
                </section>

                <section>
                    @if(empty($comment->parent_id))
                    <form action="{{route('admin.content.comment.answer',[$comment->id])}}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 my-1">
                                <div class="form-group">
                                    <label for="">پاسخ ادمین</label>
                                    ‍<textarea name="body" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                                @error('body')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-1">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                    @endif
                </section>

            </section>
        </section>
    </section>

@endsection

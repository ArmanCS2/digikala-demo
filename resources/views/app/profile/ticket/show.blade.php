@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>تیکت ها</title>
@endsection


@section('content')


    <!-- start vontent header -->
    <section class="content-header m-1">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>مشاهده تیکت</span>
            </h2>
            <section class="content-header-link m-2">
                <a href="{{route('profile.ticket.index')}}" class="btn btn-danger text-white">بازگشت</a>
            </section>
        </section>
    </section>
    <!-- end vontent header -->


    <section class="card mb-3">
        <section class="card-header text-white bg-info">
            موضوع : {{$ticket->subject}}
        </section>
        <section class="card-body border-bottom">
            <p class="card-text">{{$ticket->description}}</p>
        </section>
        @if(!empty($ticket->file))
            <section class="col-12 m-1">
                <a class="btn btn-success btn-sm" href="{{route('download',$ticket->file->file_path)}}">دانلود ضمیمه</a>
            </section>
        @endif
    </section>
    @forelse($ticket->children as $child)
        <section class="card m-3">
            <section class="card-header text-white bg-primary d-flex justify-content-between">
                <p>{{!empty($child->admin) ? $child->admin->full_name : $child->user->full_name}}</p>
                <small class="text-white">{{jalaliDate($child->created_at)}}</small>
            </section>
            <section class="card-body">
                <p class="card-text">{{$child->description}}</p>
            </section>

        </section>
    @empty
        <section class="card m-3">
            <section class="card-body">
                <p class="card-text">پاسخی وجود ندارد</p>
            </section>
        </section>
    @endforelse

    <section>
        <form action="{{route('profile.ticket.answer',[$ticket->id])}}" method="post">
            @csrf
            <section class="row">
                <section class="col-12 my-1">
                    <div class="form-group">
                        <label for="">پاسخ تیکت</label>
                        ‍<textarea class="form-control form-control-sm" rows="4"
                                   name="description">{{old('description')}}</textarea>
                    </div>
                    @error('description')
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
    </section>
@endsection




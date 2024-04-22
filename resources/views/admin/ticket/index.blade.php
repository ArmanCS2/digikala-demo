@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        تیکت ها
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
                            <th>نویسنده تیکت</th>
                            <th>عنوان تیکت</th>
                            <th>دسته تیکت</th>
                            <th>اولویت تیکت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $key => $ticket)
                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$ticket->user->full_name}}</td>
                                <td>{{$ticket->subject}}</td>
                                <td>{{$ticket->category->name}}</td>
                                <td>{{$ticket->priority->name}}</td>
                                <td class="width-22-rem text-left">
                                    @if($ticket->status == 0)
                                        <a href="{{ route('admin.ticket.change-status',[$ticket->id]) }}"
                                           class="btn btn-danger btn-sm"><i class="fa fa-times"></i> بستن </a>
                                    @else
                                        <a href="{{ route('admin.ticket.change-status',[$ticket->id]) }}"
                                           class="btn btn-success btn-sm"><i class="fa fa-check"></i> بسته شده</a>
                                    @endif
                                    <a href="{{route('admin.ticket.show',[$ticket->id])}}"
                                       class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.layouts.pagination',['data'=>$tickets])
                </section>

            </section>
        </section>
    </section>

@endsection

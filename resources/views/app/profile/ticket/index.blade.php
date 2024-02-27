@extends('app.layouts.master-two-col')

@section('head-tag')
    <title>تیکت ها</title>
@endsection


@section('content')


    <!-- start vontent header -->
    <section class="content-header">
        <section class="d-flex justify-content-between align-items-center">
            <h2 class="content-header-title">
                <span>تاریخچه تیکت ها</span>
            </h2>
            <section class="content-header-link m-2">
                <a href="{{route('profile.ticket.create')}}" class="btn btn-success text-white">ارسال تیکت جدید</a>
            </section>
        </section>
    </section>
    <!-- end vontent header -->





    <section class="order-wrapper">

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان تیکت</th>
                    <th>دسته تیکت</th>
                    <th>اولویت تیکت</th>
                    <th>تیکت مرجع</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($tickets as $ticket)

                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->category->name }}</td>
                        <td>{{ $ticket->priority->name }}</td>
                        <td>{{ $ticket->parent->subject ?? '-' }}</td>
                        <td class="width-22-rem text-left d-flex justify-content-center">
                            @if($ticket->status == 0)
                                <a href="{{ route('profile.ticket.change-status',[$ticket->id]) }}"
                                   class="btn btn-danger btn-sm m-1"><i class="fa fa-times"></i> بستن </a>
                            @else
                                <a href="{{ route('profile.ticket.change-status',[$ticket->id]) }}"
                                   class="btn btn-success btn-sm m-1"><i class="fa fa-check"></i> بسته شده</a>
                            @endif
                            <a href="{{route('profile.ticket.show',[$ticket->id])}}"
                               class="btn btn-info btn-sm text-white m-1"><i class="fa fa-eye"></i> نمایش</a>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </section>

    </section>
@endsection




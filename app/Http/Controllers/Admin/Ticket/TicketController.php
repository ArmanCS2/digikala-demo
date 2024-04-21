<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketAnswerRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newTicket()
    {
        $tickets = Ticket::where('seen', 0)->whereNull('ticket_id')->orderBy('created_at','DESC')->get();
        foreach ($tickets as $ticket) {
            $ticket->seen = 1;
            $ticket->save();
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openTicket()
    {
        $tickets = Ticket::where('status', 0)->whereNull('ticket_id')->orderBy('created_at','DESC')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function closeTicket()
    {
        $tickets = Ticket::where('status', 1)->whereNull('ticket_id')->orderBy('created_at','DESC')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::whereNull('ticket_id')->orderBy('created_at','DESC')->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function changeStatus($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status == 1 ? $ticket->status = 0 : $ticket->status = 1;
        $ticket->save();
        return redirect()->back()->with('swal-success', 'وضعیت تیکت با موفقیت تغییر یافت');
    }

    public function answer(TicketAnswerRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        $user=Auth::user();
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $user->id;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::create($inputs);
        return redirect()->back()->with('swal-success', 'پاسخ با موفقیت ثبت شد');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('admin.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.ticket.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

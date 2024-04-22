<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = TicketPriority::orderBy('created_at','DESC')->paginate(20);
        return view('admin.ticket.priority.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketPriorityRequest $request)
    {
        $inputs = $request->all();
        TicketPriority::create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priority = TicketPriority::find($id);
        return view('admin.ticket.priority.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketPriorityRequest $request, $id)
    {
        $priority = TicketPriority::find($id);
        $inputs = $request->all();
        $priority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priority = TicketPriority::find($id);
        $priority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $priority = TicketPriority::find($id);
        $priority->status == 1 ? $priority->status = 0 : $priority->status = 1;
        $result = $priority->save();
        if ($result) {
            if ($priority->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}

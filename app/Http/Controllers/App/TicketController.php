<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketAnswerRequest;
use App\Http\Requests\App\StoreTicketRequest;
use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $tickets=$user->tickets()->whereNull('ticket_id')->get();
        return view('app.profile.ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticketCategories=TicketCategory::all();
        $ticketPriorities=TicketPriority::all();
        return view('app.profile.ticket.create',compact('ticketCategories','ticketPriorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request,FileService $fileService)
    {
        DB::transaction(function ()use ($request,$fileService){
            $user=Auth::user();
            $inputs=$request->all();
            $inputs['user_id']=$user->id;
            $ticket=Ticket::create($inputs);

            if ($request->hasFile('file')){
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
                $result=$fileService->moveToPublic($request->file('file'));
                if (!$result){
                    return redirect()->back()->with('swal-error', 'آپلود فایل با خطا مواجه شد');
                }

                TicketFile::create([
                    'file_path'=>$result,
                    'file_type'=>$fileService->getFileFormat(),
                    'file_size'=>$fileService->getFileSize(),
                    'ticket_id'=>$ticket->id,
                    'user_id'=>$user->id
                ]);
            }

            return redirect()->route('profile.ticket.index')->with('swal-success', 'تیکت با موفقیت ثبت شد');

        });
        return redirect()->route('profile.ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('app.profile.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function changeStatus($id)
    {
        $ticket = Ticket::find($id);
        if($ticket->status==0){
            $ticket->status=1;
            $ticket->save();
            return redirect()->back()->with('swal-success', 'وضعیت تیکت با موفقیت تغییر یافت');
        }
        return redirect()->back()->with('toast-info', 'تیکت بسته شده');
    }


    public function answer(TicketAnswerRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 0;
        $inputs['user_id'] = Auth::user()->id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::create($inputs);
        return redirect()->back()->with('swal-success', 'پاسخ با موفقیت ثبت شد');
    }
}

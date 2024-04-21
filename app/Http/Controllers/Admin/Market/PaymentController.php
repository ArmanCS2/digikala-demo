<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments=Payment::orderBy('created_at','DESC')->get();
        return view('admin.market.payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function online()
    {
        $payments=Payment::where('paymentable_type','App\Models\Market\OnlinePayment')->orderBy('created_at','DESC')->get();
        return view('admin.market.payment.index',compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function offline()
    {
        $payments=Payment::where('paymentable_type','App\Models\Market\OfflinePayment')->orderBy('created_at','DESC')->get();
        return view('admin.market.payment.index',compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cash()
    {
        $payments=Payment::where('paymentable_type','App\Models\Market\CashPayment')->orderBy('created_at','DESC')->get();
        return view('admin.market.payment.index',compact('payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        return view('admin.market.payment.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment=Payment::find($id);
        return view('admin.market.payment.show',compact('payment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $payment=Payment::find($id);
        $payment->status=2;
        $payment->save();
        return redirect()->back()->with('swal-success','پرداخت با موفقیت لغو شد');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payback($id)
    {
        $payment=Payment::find($id);
        $payment->status=3;
        $payment->save();
        return redirect()->back()->with('swal-success','پرداخت با موفقیت بازگردانده شد');
    }
}

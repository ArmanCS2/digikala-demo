<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newOrder()
    {
        $orders = Order::where('order_status', 0)->get();
        foreach ($orders as $order) {
            $order->order_status = 1;
            $order->save();
        }
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sending()
    {
        $orders = Order::where('delivery_status', 1)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function canceled()
    {
        $orders = Order::where('order_status', 4)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unpaid()
    {
        $orders = Order::where('payment_status', 0)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function returned()
    {
        $orders = Order::where('order_status', 5)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showFactor($id)
    {
        $order=Order::find($id);
        return view('admin.market.order.show-factor',compact('order'));
    }

    public function showDetail($id)
    {
        $order=Order::find($id);
        return view('admin.market.order.show-detail',compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function changeSendStatus($id)
    {
        $order = Order::find($id);
        if ($order->delivery_status == 0) {
            $order->delivery_status = 1;
        } elseif ($order->delivery_status == 1) {
            $order->delivery_status = 2;
        } elseif ($order->delivery_status == 2) {
            $order->delivery_status = 3;
        } else {
            $order->delivery_status = 0;
        }
        $order->save();
        return redirect()->back();
    }

    public function changeOrderStatus($id)
    {
        $order = Order::find($id);
        if ($order->order_status == 1) {
            $order->order_status = 2;
        } elseif ($order->order_status == 2) {
            $order->order_status = 3;
        } elseif ($order->order_status == 3) {
            $order->order_status = 4;
        } elseif ($order->order_status == 4) {
            $order->order_status = 5;
        } else {
            $order->order_status = 1;
        }
        $order->save();
        return redirect()->back();
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->order_status = 5;
        $order->save();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('app.market.payment');
    }
}

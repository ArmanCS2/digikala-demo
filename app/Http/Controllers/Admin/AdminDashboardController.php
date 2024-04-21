<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $tickets = Ticket::orderBy('created_at', 'DESC')->get();
        $comments = Comment::orderBy('created_at', 'DESC')->get();
        $products = Product::all();
        $marketableProducts = Product::where('marketable_number', '>', 0)->get();
        $frozenProducts = Product::where('frozen_number', '>', 0)->get();
        $soldProducts = Product::where('sold_number', '>', 0)->get();
        $payments = OnlinePayment::all();
        $posts = Post::all();
        $users = User::where('user_type', 0)->get();
        return view('admin.index', compact('orders', 'tickets', 'comments', 'products', 'marketableProducts', 'frozenProducts', 'soldProducts', 'payments', 'posts', 'users'));
    }
}

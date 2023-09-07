<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function dashboard()
    {
        $orders = Order::orderBy('id','DESC')->get();

        return view('backend.seller.index', compact('orders'));
    }
}

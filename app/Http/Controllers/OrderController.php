<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    public function detailsOrder($id)
    {
        $orders = Orders::where('id', $id)->with('orders')->first();
        return view('admin.order.details-order', compact('orders'));
    }
}

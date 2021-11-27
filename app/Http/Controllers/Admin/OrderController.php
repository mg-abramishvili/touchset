<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product', 'orderItems.addons')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }
}

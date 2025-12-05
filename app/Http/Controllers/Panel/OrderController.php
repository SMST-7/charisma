<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orderItems = OrderItem::with([
            'product',
            'order.user',
            'order.address'
        ])->latest()->paginate(20);

        return view('panel.orders.index', compact('orderItems'));
    }



    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])
            ->findOrFail($id);

        return view('panel.orders.show', compact('order'));
    }


}
